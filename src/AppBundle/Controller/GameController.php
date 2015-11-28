<?php

namespace AppBundle\Controller;

use AppBundle\Model\Game;
use Faker\Factory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    /**
     * @Route("/game")
     * @Route("/game/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("homepage", [], 302);
    }


    /**
     * @Route("/game/{id}", requirements={"id" = "^[1-9]+[\d]*$"}, name="show_game_by_id")
     * @Template()
     *
     */
    public function showAction($id)
    {
        $game = new Game($id);

        $faker = Factory::create();
        $game->setFirstTeam($faker->country);
        $game->setSecondTeam($faker->country);

        return ['game' => $game];
    }

}

