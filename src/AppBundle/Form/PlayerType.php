<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 25.12.15
 * Time: 10:50
 */

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use AppBundle\Form\TeamType;

class PlayerType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team', EntityType::class, array(
                'class' => 'AppBundle:Team',
                'choice_label' => 'name',
            ))
            ->add('name', TextType::class)
            ->add('position', ChoiceType::class, array(
                    'choices' => array(
                        'Defender' => 'Defender',
                        'Goal Keeper' => 'Goal Keeper',
                        'Midfielder' => 'Midfielder',
                        'Forward' => 'Forward'
                    ),
                    'choices_as_values' => true,
                )
            )
            ->add('height', IntegerType::class)
            ->add('weight', IntegerType::class)
            ->add('squadNumber', IntegerType::class)
            ->add('dateOfBirth', DateType::class, array(
                'years' => range(1945, 2015),
            ))
            ->add('shortBiography', TextareaType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Player',
            'em' => null,
        ));
    }

}