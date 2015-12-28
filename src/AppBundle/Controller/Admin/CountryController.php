<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 13:45
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Country;
use AppBundle\Form\CountryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class CountryController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/country")
 */
class CountryController extends Controller
{

    /**
     * @Route("/manage", name="manage_countries")
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
     * @Route("/new", name="new_country")
     * @Template()
     *
     */
    public function newAction()
    {
        $country = new Country();

        $form = $this->createForm(
            CountryType::class,
            $country,
            array(
                'action' => $this->generateUrl('create_country'),
                'method' => 'POST',
            )
        );

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
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(
            CountryType::class,
            $country,
            array(
                'action' => $this->generateUrl('create_country'),
                'method' => 'POST',
                'em' => $em,
            )
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('manage_countries');
        }

    }

    /**
     * @param $slug
     * @param Request $request
     * @Route("/edit/{slug}", name="edit_country")
     * @Template()
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $country = $em->getRepository('AppBundle:Country')
            ->findOneBy(['slug' => $slug]);

        $form = $this->createForm(
            CountryType::class,
            $country,
            [
                'em' => $em,
                'action' => $this->generateUrl('edit_country', ['slug' => $slug]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($country);
                $em->flush();

                return $this->redirectToRoute('manage_countries');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param $slug
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/remove/{slug}", name="remove_country")
     * @Template()
     */
    public function removeAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $country = $em->getRepository('AppBundle:Country')
            ->findOneBy(['slug' => $slug]);

        $form = $this->createForm(
            CountryType::class,
            $country,
            [
                'em' => $em,
                'action' => $this->generateUrl('remove_country', ['slug' => $slug]),
                'method' => Request::METHOD_POST,
            ]
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->remove($country);
                $em->flush();

                return $this->redirectToRoute('manage_countries');
            }
        }

        return ['form' => $form->createView()];
    }

}