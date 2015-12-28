<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 22:48
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Game;
use AppBundle\Form\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GameController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/game")
 */
class GameController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Route("/manage", name="manage_games")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $games = $em->getRepository('AppBundle:Game')
            ->findAllGamesWithDependencies();

        $pager = $this->get('knp_paginator');
        $pagination = $pager->paginate($games, $request->query->getInt('page', 1), 50);

        return ['games' => $pagination];
    }


    /**
     * @return array
     * @Route("/new", name="add_new_game")
     * @Template()
     */
    public function newAction()
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game, array(
            'action' => $this->generateUrl('create_game'),
            'method' => 'POST'
        ));

        return [
          'game' => $game,
          'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/create", name="create_game")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $game = new Game();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(GameType::class, $game, array(
            'action' => $this->generateUrl('create_game'),
            'method' => 'POST',
            'em' => $em,
        ));

        $form->handleRequest($request);

        if($form->isValid()) {

            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/edit/{id}", name="edit_game")
     * @Template()
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $game = $em->getRepository('AppBundle:Game')
            ->find($id);

        $form = $this->createForm(
            GameType::class,
            $game,
            [
                'em' => $em,
                'action' => $this->generateUrl('edit_game', ['id' => $id]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($game);
                $em->flush();

                return $this->redirectToRoute('manage_games');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/remove/{id}", name="remove_game")
     * @Template()
     */
    public function removeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $game = $em->getRepository('AppBundle:Game')
            ->find($id);

        $form = $this->createForm(
            GameType::class,
            $game,
            [
                'em' => $em,
                'action' => $this->generateUrl('remove_game', ['id' => $id]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->remove($game);
                $em->flush();

                return $this->redirectToRoute('manage_games');
            }
        }

        return ['form' => $form->createView()];
    }
}