<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 19.11.15
 * Time: 15:24
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends  Controller
{
    /**
     * @Route("/team")
     */
    public function indexAction(Request $request)
    {
        return $this->render('@App/team/team.html.twig', array());
    }

    /**
     * @Route("/team/{id}")
     */
    public function showAction($id)
    {
        return $this->render('@App/team/team.html.twig', array());
    }
}