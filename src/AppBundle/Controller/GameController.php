<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
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
        $game = $this->getDoctrine()
            ->getRepository('AppBundle:Game')
            ->findGameWithDependencies($id);

        if (!$game) {
            throw $this->createNotFoundException('No game found for id: '.$id);
        }


        return ['game' => $game];
    }

}

