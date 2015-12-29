<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 17:45
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TeamController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/team")
 */
class TeamController extends Controller
{
    /**
     * @return array
     * @Route("/manage", name="manage_teams")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('AppBundle:Team')
            ->findAll();

        return [
            'teams' => $teams,
        ];
    }

    /**
     * @return array
     * @Route("/new", name="new_team")
     * @Template()
     */
    public function newAction()
    {
        $team = new Team();

        $form = $this->createForm(
            TeamType::class,
            $team,
            array(
                'action' => $this->generateUrl('create_team'),
                'method' => 'POST',
            )
        );

        return [
            'team' => $team,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/create", name="create_team")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $team = new Team();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(
            TeamType::class,
            $team,
            array(
                'action' => $this->generateUrl('create_team'),
                'method' => 'POST',
                'em' => $em,
            )
        );
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @param $slug
     * @param Request $request
     * @Route("/edit/{slug}", name="edit_team")
     * @Template()
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $team = $em->getRepository('AppBundle:Team')
            ->findOneBy(['slug' => $slug]);

        $form = $this->createForm(
            TeamType::class,
            $team,
            [
                'em' => $em,
                'action' => $this->generateUrl('edit_team', ['slug' => $slug]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($team);
                $em->flush();

                return $this->redirectToRoute('manage_teams');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param $slug
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/remove/{slug}", name="remove_team")
     * @Template()
     */
    public function removeAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $team = $em->getRepository('AppBundle:Team')
            ->findOneBy(['slug' => $slug]);

        $form = $this->createForm(
            TeamType::class,
            $team,
            [
                'em' => $em,
                'action' => $this->generateUrl('remove_team', ['slug' => $slug]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->remove($team);
                $em->flush();

                return $this->redirectToRoute('manage_teams');
            }
        }

        return ['form' => $form->createView()];
    }
}