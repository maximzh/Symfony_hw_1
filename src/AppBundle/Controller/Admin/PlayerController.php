<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 17:10
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayerController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/player")
 */
class PlayerController extends Controller
{
    /**
     * @return array
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $player = new Player();

        $form = $this->createForm(PlayerType::class, $player, array(
            'action' => $this->generateUrl('create_player'),
            'method' => 'POST'
        ));

        return [
            'player' => $player,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @Route("/create", name="create_player")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $player = new Player();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(PlayerType::class, $player, array(
            'action' => $this->generateUrl('create_player'),
            'method' => 'POST',
            'em' => $em,
        ));
        $form->handleRequest($request);

        if($form->isValid()) {

            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
    }
}