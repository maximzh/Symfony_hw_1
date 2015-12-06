<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 05.12.15
 * Time: 0:32
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Coach;
use AppBundle\Entity\Country;
use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class GenerateController extends Controller
{
    /**
     * @Route("/generate")
     * @Method("GET")
     */
    public function indexAction()
    {
        $teams = [
            "France", "Italy", "Czech Republic", "Turkey",
            "Spain", "Russia", "Sweden", "Republic Of Ireland",
            "Germany", "Switzerland", "Poland", "Iceland",
            "England", "Austria", "Romania", "Wales",
            "Portugal", "Croatia", "Slovakia", "Albania",
            "Belgium", "Ukraine", "Hungary", "Northern Ireland"
        ];

        $positions = array('Goal keeper', 'Defender', 'Midfielder', 'Forward');

        $faker = Factory::create();

        $em = $this->getDoctrine()->getManager();


        foreach($teams as $value) {

            $team = new Team();
            $team->setName($value);
            $teamSlug = strtolower($team->getName());
            $teamSlug = str_replace(' ', '-', $teamSlug);
            $team->setSlug($teamSlug);


            $country = new Country();
            $country->setName($team->getName());
            $country->setUefaRank($faker->numberBetween(1, 54));
            $countrySlug = $country->getName();
            $countrySlug = strtolower($countrySlug);
            $countrySlug = str_replace(' ', '_', $countrySlug);
            $country->setSlug($countrySlug);
            $country->setFirstMembership($faker->year);
            $country->setNationalTeamFoundedAt($faker->year);
            $flag = '/pictures/'.$country->getSlug().'.png';
            $country->setFlag($flag);
            $country->setShortHistory($faker->text(1000));
            $country->setTeam($team);
            $em->persist($country);

            $i = 0;

            while($i++ < 15) {

                $player = new Player();

                $player->setName($faker->firstNameMale.' '.$faker->lastName);

                $position = $positions[array_rand($positions)];
                $player->setPosition($position);

                $squadNumber = $faker->numberBetween(1, 100);
                $player->setSquadNumber($squadNumber);

                $height = $faker->numberBetween(165, 195);
                $player->setHeight($height);

                $weight = $faker->numberBetween(65, 90);
                $player->setWeight($weight);

                $dateOfBirth = $faker->dateTimeBetween('-35 years', '-21 years');
                $player->setDateOfBirth($dateOfBirth);

                $shortBiography = $faker->text(1000);
                $player->setShortBiography($shortBiography);

                $player->setTeam($team);

                $team->addPlayer($player);


                $em->persist($player);

            }

            $i = 0;
            while($i++ < 3) {

                $coach = new Coach();

                $coach->setTeam($team);

                $coach->setName($faker->firstNameMale.' '.$faker->lastName);

                $dateOfBirth = $faker->dateTimeBetween('-65 years', '-40 years');
                $coach->setDateOfBirth($dateOfBirth);

                $coach->setNationality($faker->country);

                $em->persist($coach);
            }

            $em->persist($team);
            $em->flush();


        }

        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findAll();

        foreach($teams as $team) {
            $game = new Game();
            $game->setFirstTeam($team);
            $game->setFirstTeamScore($faker->numberBetween(0, 5));
            $game->setSecondTeamScore($faker->numberBetween(0, 5));
            $game->setGameDate($faker->dateTime);
            $game->setGameStartsAt($faker->time('H:i'));
            $randomCountry = $teams[array_rand($teams)];
            $game->setSecondTeam($randomCountry);
            $em->persist($game);
        }
        $em->flush();

        return new Response('Fake data generated and saved to database');
    }
}