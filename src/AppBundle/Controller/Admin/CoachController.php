<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 28.12.15
 * Time: 15:43
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Coach;
use AppBundle\Form\CoachType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CoachController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/coach")
 */
class CoachController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Route("/manage", name="manage_coaches")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coaches = $em->getRepository('AppBundle:Coach')
            ->findAllCoachesWithDependencies();

        $pager = $this->get('knp_paginator');
        $pagination = $pager->paginate($coaches, $request->query->getInt('page', 1), 24);

        return ['coaches' => $pagination];
    }

    /**
     * @return array
     * @Route("/new", name="add_new_coach")
     * @Template()
     */
    public function newAction()
    {
        $coach = new Coach();

        $form = $this->createForm(
            CoachType::class,
            $coach,
            array(
                'action' => $this->generateUrl('create_coach'),
                'method' => Request::METHOD_POST,
            )
        );

        return [
            'coach' => $coach,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @Route("/create", name="create_coach")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $coach = new Coach();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(
            CoachType::class,
            $coach,
            array(
                'action' => $this->generateUrl('create_coach'),
                'method' => Request::METHOD_POST,
                'em' => $em,
            )
        );
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($coach);
            $em->flush();

            return $this->redirectToRoute('manage_coaches');
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/edit/{id}", name="edit_coach")
     * @Template()
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coach = $em->getRepository('AppBundle:Coach')
            ->find($id);

        $form = $this->createForm(
            CoachType::class,
            $coach,
            [
                'em' => $em,
                'action' => $this->generateUrl('edit_coach', ['id' => $id]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($coach);
                $em->flush();

                return $this->redirectToRoute('manage_coaches');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/remove/{id}", name="remove_coach")
     * @Template()
     */
    public function removeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coach = $em->getRepository('AppBundle:Coach')
            ->find($id);

        $form = $this->createForm(
            CoachType::class,
            $coach,
            [
                'em' => $em,
                'action' => $this->generateUrl('remove_coach', ['id' => $id]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->remove($coach);
                $em->flush();

                return $this->redirectToRoute('manage_players');
            }
        }

        return ['form' => $form->createView()];
    }
}