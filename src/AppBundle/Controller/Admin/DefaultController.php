<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 28.12.15
 * Time: 19:20
 */

namespace AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin_default")
     * @Route("/admin/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("manage_countries");
    }
}