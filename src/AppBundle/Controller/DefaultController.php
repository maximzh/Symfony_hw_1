<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $potOne = ['france', 'spain', 'germany', 'england', 'portugal', 'belgium'];
        $potTwo = ['italy', 'russia', 'switzerland', 'austria', 'croatia', 'ukraine'];
        $potThree = ['czech_republic', 'sweden', 'poland', 'romania', 'slovakia', 'hungary'];
        $potFour = ['turkey', 'republic_of_ireland', 'iceland', 'wales', 'albania', 'northern_ireland'];
        $data['potOne'] = $potOne;
        $data['potTwo'] = $potTwo;
        $data['potThree'] = $potThree;
        $data['potFour'] = $potFour;
        return [
            'data' => $data
        ];
    }
}
