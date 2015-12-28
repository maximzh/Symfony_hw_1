<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 17:13
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->add(
                'country',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Country',
                    'choice_label' => 'name',
                    'placeholder' => 'Choose country',
                )
            )
            ->add(
                'tournamentGroup',
                EntityType::class,
                array(
                    'class' => 'AppBundle:TournamentGroup',
                    'choice_label' => 'name',
                    'placeholder' => 'select group',
                    'required' => false
                )
            );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Team',
                'em' => null,
            )
        );
    }
}