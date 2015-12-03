<?php

namespace AppBundle\Controller;

use AppBundle\Model\Country;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $potOne = ['france', 'spain', 'gerMany', 'england', 'portugal', 'belgium'];
        $potTwo = ['italy', 'russia', 'switzerland', 'austria', 'croatia', 'ukraine'];
        $potThree = ['czech_republic', 'sweden', 'poland', 'romania', 'slovakia', 'hungary'];
        $potFour = ['turkey', 'republic_of_ireland', 'iceland', 'wales', 'albania', 'northern ireland'];
        $data['potOne'] = $potOne;
        $data['potTwo'] = $potTwo;
        $data['potThree'] = $potThree;
        $data['potFour'] = $potFour;

        foreach ($potOne as $country) {
            $potOneCountries[] = new Country($country);
        }

        foreach ($potTwo as $country) {
            $potTwoCountries[] = new Country($country);
        }

        foreach ($potThree as $country) {
            $potThreeCountries[] = new Country($country);
        }

        foreach ($potFour as $country) {
            $potFourCountries[] = new Country($country);
        }

        return [
            'pot_one' => $potOneCountries,
            'pot_two' => $potTwoCountries,
            'pot_three' => $potThreeCountries,
            'pot_four' => $potFourCountries,
        ];
    }
}
