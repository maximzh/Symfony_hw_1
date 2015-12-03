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
     * @Route("/player/{player}", name="show_player", requirements={"player" = "^[a-z]+[a-z_-]*[a-z]+$"})
     * @Template()
     * @Method("GET")
     */
    public function showAction($player)
    {
        $instance = new Player($player);
        //$instance = $instance->generateData();

        return ['player' => $instance];
    }
}