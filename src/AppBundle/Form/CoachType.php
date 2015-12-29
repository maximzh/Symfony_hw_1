<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 28.12.15
 * Time: 15:45
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoachType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'team',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Team',
                    'choice_label' => 'name',
                )
            )
            ->add('name', TextType::class)
            ->add(
                'dateOfBirth',
                DateType::class,
                array(
                    'years' => range(1945, 2015),
                )
            )
            ->add('shortBiography', TextareaType::class);

        $builder->get('name')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $event->setData(trim(ucwords(strtolower($event->getData()))));
            }
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Coach',
                'em' => null,
            )
        );
    }
}