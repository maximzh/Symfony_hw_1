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
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    /**
     * @Route("/player", name="show_all_players")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        //return $this->redirectToRoute("homepage",[], 302);
       /*
        $curPage = $request->query->getInt('page', 1);
        $limit = 50;
        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository('AppBundle:Player')->countAllPlayers();
        $users = $em->getRepository('AppBundle:Player')->getAllUsersWithPagination($limit, $curPage);

        if($count > ($limit*$curPage) ) {
            $nextPage = $curPage+1;
        } else $nextPage = false;

        if ($request->isXmlHttpRequest()) {
            $content = $this->renderView('AppBundle:Player:body.html.twig',
                ['users' => $users , 'nextPage' => $nextPage]);
            return new Response($content);
        }
        return ['users' => $users , 'nextPage' => $nextPage];
       */

        $em = $this->getDoctrine()->getManager();

        $players = $em->getRepository('AppBundle:Player')
            ->findAllPlayersWithDependencies();

        $pager = $this->get('knp_paginator');
        $pagination = $pager->paginate($players, $request->query->getInt('page', 1), 20);

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

        if(!$player) {
            throw $this->createNotFoundException('No player found for id '.$id);
        }

        return ['player' => $player];
    }
}