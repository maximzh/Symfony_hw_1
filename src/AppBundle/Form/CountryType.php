<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 13:12
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CountryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add(
                'flag',
                TextType::class,
                array(
                    'label' => 'Flag image name, for example Ukraine.png',
                    'required' => false,
                )
            )
            ->add('uefaRank', IntegerType::class)
            ->add('shortHistory', TextareaType::class);
        $builder->get('name')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $event->setData(trim(ucfirst(strtolower($event->getData()))));
            }
        );
        $builder->get('slug')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $slug = strtolower($event->getData());
                $slug = str_replace(' ', '-', $slug);
                $event->setData($slug);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Country',
                'em' => null,
            )
        );
    }
}