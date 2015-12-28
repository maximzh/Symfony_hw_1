<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 22:24
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstTeam', EntityType::class, array(
                'class' => 'AppBundle:Team',
                'choice_label' => 'name',
                'placeholder' => 'Choose team',
                'required' => false,
            ))
            ->add('secondTeam', EntityType::class, array(
                'class' => 'AppBundle:Team',
                'choice_label' => 'name',
                'placeholder' => 'Choose team',
                'required' => false,
            ))
            ->add('firstTeamScore', IntegerType::class, array(
                'required' =>false
            ))
            ->add('secondTeamScore', IntegerType::class, array(
                'required' =>false
            ))
            ->add('gameStartsAt')
            ->add('city')
            ->add('gameDate', DateType::class)
            ->add('description', TextareaType::class)
            ->add('tournamentGroup', EntityType::class, array(
                'class' => 'AppBundle:TournamentGroup',
                'choice_label' => 'name',
                'placeholder' => 'No Group',
                'required' => false,
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Game',
            'em' => null,
        ]);
    }
}