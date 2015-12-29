<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 27.12.15
 * Time: 21:15
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\TournamentGroup;
use AppBundle\Form\TournamentGroupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TournamentGroupController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/group")
 */
class TournamentGroupController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Route("/manage", name="manage_groups")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('AppBundle:TournamentGroup')
            ->findAll();

        return ['groups' => $groups];
    }

    /**
     * @Route("/new", name="new_group")
     * @Template()
     */
    public function newAction()
    {
        $group = new TournamentGroup();

        $form = $this->createForm(
            TournamentGroupType::class,
            $group,
            array(
                'action' => $this->generateUrl('create_group'),
                'method' => 'POST',
            )
        );

        return [
            'group' => $group,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/create", name="create_group")
     */
    public function createAction(Request $request)
    {
        $group = new TournamentGroup();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(
            TournamentGroupType::class,
            $group,
            array(
                'action' => $this->generateUrl('create_group'),
                'method' => 'POST',
                'em' => $em,
            )
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @param $name
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/edit/{name}", name="edit_group")
     * @Template()
     */
    public function editAction($name, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $group = $em->getRepository('AppBundle:TournamentGroup')
            ->findOneBy(['name' => $name]);

        $form = $this->createForm(
            TournamentGroupType::class,
            $group,
            [
                'em' => $em,
                'action' => $this->generateUrl('edit_group', ['name' => $name]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($group);
                $em->flush();

                return $this->redirectToRoute('manage_groups');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param $name
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/remove/{name}", name="remove_group")
     * @Template()
     */
    public function removeAction($name, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $group = $em->getRepository('AppBundle:TournamentGroup')
            ->findOneBy(['name' => $name]);

        $form = $this->createForm(
            TournamentGroupType::class,
            $group,
            [
                'em' => $em,
                'action' => $this->generateUrl('remove_group', ['name' => $name]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->remove($group);
                $em->flush();

                return $this->redirectToRoute('manage_groups');
            }
        }

        return ['form' => $form->createView()];
    }
}