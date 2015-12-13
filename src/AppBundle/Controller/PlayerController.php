<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 20.11.15
 * Time: 22:16
 */

namespace AppBundle\Controller;


use AppBundle\Model\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    /**
     * @Route("/player")
     * @Route("/player/")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("homepage",[], 302);
    }

    /**
     * @Route("/player/{id}", name="show_player", requirements={"id" = "\d+"})
     * @Template()
     * @Method("GET")
     */
    public function showAction($id)
    {

        $player = $this->getDoctrine()
            ->getRepository('AppBundle:Player')
            ->find($id);

        if(!$player) {
            throw $this->createNotFoundException('No player found for id '.$id);
        }

        return ['player' => $player];
    }
}