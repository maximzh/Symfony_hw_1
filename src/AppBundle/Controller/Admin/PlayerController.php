<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 17:10
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayerController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/player")
 */
class PlayerController extends Controller
{

    /**
     * @param Request $request
     * @return array
     * @Route("/manage", name="manage_players")
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
     * @return array
     * @Route("/new", name="add_new_player")
     * @Template()
     */
    public function newAction()
    {
        $player = new Player();

        $form = $this->createForm(
            PlayerType::class,
            $player,
            array(
                'action' => $this->generateUrl('create_player'),
                'method' => 'POST',
            )
        );

        return [
            'player' => $player,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @Route("/create", name="create_player")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $player = new Player();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(
            PlayerType::class,
            $player,
            array(
                'action' => $this->generateUrl('create_player'),
                'method' => 'POST',
                'em' => $em,
            )
        );
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('manage_players');
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/edit/{id}", name="edit_player")
     * @Template()
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $player = $em->getRepository('AppBundle:Player')
            ->find($id);

        $form = $this->createForm(
            PlayerType::class,
            $player,
            [
                'em' => $em,
                'action' => $this->generateUrl('edit_player', ['id' => $id]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($player);
                $em->flush();

                return $this->redirectToRoute('manage_players');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/remove/{id}", name="remove_player")
     * @Template()
     */
    public function removeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $player = $em->getRepository('AppBundle:Player')
            ->find($id);

        $form = $this->createForm(
            PlayerType::class,
            $player,
            [
                'em' => $em,
                'action' => $this->generateUrl('remove_player', ['id' => $id]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->remove($player);
                $em->flush();

                return $this->redirectToRoute('manage_players');
            }
        }

        return ['form' => $form->createView()];
    }
}