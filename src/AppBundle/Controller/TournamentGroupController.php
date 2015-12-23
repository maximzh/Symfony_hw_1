<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 20.12.15
 * Time: 17:53
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TournamentGroupController extends Controller
{
    /**
     * @param $name
     * @return array
     * @Route("/group/{name}", name="show_group")
     * @Template()
     */
    public function showAction($name)
    {
        /*$group = $this->getDoctrine()
            ->getRepository('AppBundle:TournamentGroup')
            ->findGroupWithDependencies($id);

        if(!$group) {

            throw $this->createNotFoundException('No group found for id: '.$id);
        }*/

        $games = $this->getDoctrine()
            ->getRepository('AppBundle:Game')
            ->findGamesByGroup($name);

        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findTeamsByGroup($name);

        return [
            //'group' => $group
            'teams' => $teams,
            'games' => $games
        ];
    }

    /**
     * @Route("/group", name="show_all_groups")
     * @Template()
     */
    public function indexAction()
    {
       $groups = $this->getDoctrine()
           ->getRepository('AppBundle:TournamentGroup')
           ->findAllGroupsWithDependencies();
           //->findAll();


        return ['groups' => $groups];
    }

}