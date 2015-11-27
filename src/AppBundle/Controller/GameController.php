<?php

namespace AppBundle\Controller;

use AppBundle\Model\Game;
use Faker\Factory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
        $game = new Game();
        $game->setId($id);
        return [];
    }


    public function lastGamesAction($team)
    {
        $lastGames = Game::getLastGames($team);

        foreach ($lastGames as $item) {
            $data[] = $item->getFirstTeam().' '.$item->getResult()[0].' - '.$item->getResult(
                )[1].' '.$item->getSecondTeam();
        }

        return new Response(implode("\n", $data));
    }
}

