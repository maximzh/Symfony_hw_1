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
     * @Template("AppBundle:country:country.html.twig")
     */
    public function indexAction()
    {
        return [];
    }
}