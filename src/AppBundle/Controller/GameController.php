<?php

namespace AppBundle\Controller;

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
        //$arr['test'] = 'some';
        //$response = new Response();
       // $response->setContent($arr);

        return [];
    }
}

