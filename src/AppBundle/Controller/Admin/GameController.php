<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.12.15
 * Time: 22:48
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Game;
use AppBundle\Form\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GameController
 * @package AppBundle\Controller\Admin
 * @Route("/admin/game")
 */
class GameController extends Controller
{
    /**
     * @return array
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game, array(
            'action' => $this->generateUrl('create_game'),
            'method' => 'POST'
        ));

        return [
          'game' => $game,
          'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/create", name="create_game")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $game = new Game();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(GameType::class, $game, array(
            'action' => $this->generateUrl('create_game'),
            'method' => 'POST',
            'em' => $em,
        ));

        $form->handleRequest($request);

        if($form->isValid()) {

            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
    }
}