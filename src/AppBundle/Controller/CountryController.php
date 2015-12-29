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

class CountryController extends Controller
{
    /**
     * @Route("/country")
     * @Route("/country/")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("homepage", [], 302);
    }

    /**
     * @Route("/country/{slug}", requirements={"slug" = "^[a-zA-Z- ]+$"}, name="show_country")
     * @Template()
     * @Method("GET")
     */
    public function showAction($slug)
    {
        $country = $this->getDoctrine()
            ->getRepository('AppBundle:Country')
            ->findOneBy(array('slug' => $slug));

        if (!$country) {
            throw $this->createNotFoundException('No country found: '.$slug);
        }

        return ['country' => $country];
    }
}