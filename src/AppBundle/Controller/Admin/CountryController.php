<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 13:45
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Country;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\CountryType;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class CountryController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/country")
 */
class CountryController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $countries = $em->getRepository('AppBundle:Country')->findAll();

        return [
            'countries' => $countries,
        ];
    }

    /**
     * @Route("/new")
     * @Template()
     *
     */
    public function newAction()
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country, array(
            'action' => $this->generateUrl('create_country'),
            'method' => 'POST'
        ));

        return [
          'country' => $country,
          'form' => $form->createView(),
        ];

    }

    /**
     * @param Request $request
     * @Route("/create", name="create_country")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country, array(
            'action' => $this->generateUrl('create_country'),
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

    }

}