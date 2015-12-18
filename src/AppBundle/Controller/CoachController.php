<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 05.12.15
 * Time: 16:29
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CoachController extends Controller
{

    /**
     * @Route("/coach/{id}", requirements={"id" = "\d+"}, name="show_coach")
     * @Template()
     * @Method("GET")
     */
    public function showAction($id)
    {
        $coach = $this->getDoctrine()
            ->getRepository('AppBundle:Coach')
            ->find($id);

        if (!$coach) {
            throw $this->createNotFoundException('No coach found for id: '.$id);
        }

        return ['coach' => $coach];
    }
}