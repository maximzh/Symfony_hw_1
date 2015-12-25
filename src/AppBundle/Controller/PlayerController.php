<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 20.11.15
 * Time: 22:16
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{
    /**
     * @Route("/player", name="show_all_players")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $players = $em->getRepository('AppBundle:Player')
            ->findAllPlayersWithDependencies();

        $pager = $this->get('knp_paginator');
        $pagination = $pager->paginate($players, $request->query->getInt('page', 1), 30);

        return ['players' => $pagination];
    }

    /**
     * @Route("/player/{id}", name="show_player", requirements={"id" = "\d+"})
     * @Template()
     * @Method("GET")
     */
    public function showAction($id)
    {
        $player = $this->getDoctrine()
            ->getRepository('AppBundle:Player')
            ->find($id);
        if (!$player) {
            throw $this->createNotFoundException('No player found for id '.$id);
        }

        return ['player' => $player];
    }
}