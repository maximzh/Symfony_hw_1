<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 20.11.15
 * Time: 1:01
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    /**
     * @Route("/country")
     * @Route("/country/")
     * @Template("AppBundle:country:country.html.twig")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("homepage", [], 302);
    }

    /**
     * @Route("/country/{country}", requirements={"country" = "^[a-z]+[a-z_-]+[a-z]+$"}, name="show_country")
     * @Template("AppBundle:country:country.html.twig")
     * @Method("GET")
     */
    public function showAction($country)
    {
        return [];
    }
}