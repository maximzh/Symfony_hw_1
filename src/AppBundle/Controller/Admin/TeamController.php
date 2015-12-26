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
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $team = new Team();

        $form = $this->createForm(TeamType::class, $team, array(
            'action' => $this->generateUrl('create_team'),
            'method' => 'POST'
        ));

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

        $form = $this->createForm(TeamType::class, $team, array(
            'action' => $this->generateUrl('create_team'),
            'method' => 'POST',
            'em' => $em,
        ));
        $form->handleRequest($request);

        if($form->isValid()) {

            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
    }
}