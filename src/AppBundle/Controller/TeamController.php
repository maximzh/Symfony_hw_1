<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 19.11.15
 * Time: 15:24
 */

namespace AppBundle\Controller;

use AppBundle\Model\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;

class TeamController extends Controller
{
    /**
     * @Route("/team")
     * @Route("/team/")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("homepage", [], 302);
    }

    /**
     * @Route("/team/{slug}", requirements={"team" = "^[a-z]+[a-z_-]*[a-z]+$"}, name="show_team")
     * @Template()
     * @Method("GET")
     */
    public function showAction($slug)
    {
        $team = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findOneBy(array('slug' => $slug));


        return ['team' => $team];
    }

}