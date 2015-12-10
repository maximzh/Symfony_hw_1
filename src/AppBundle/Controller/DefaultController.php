<?php

namespace AppBundle\Controller;

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
        $potOne = ['France', 'Spain', 'Germany', 'England', 'Portugal', 'Belgium'];
        $potTwo = ['Italy', 'Russia', 'Switzerland', 'Austria', 'Croatia', 'Ukraine'];
        $potThree = ['Czech Republic', 'Sweden', 'Poland', 'Romania', 'Slovakia', 'Hungary'];
        $potFour = ['Turkey', 'Republic Of Ireland', 'Iceland', 'Wales', 'Albania', 'Northern Ireland'];


        $allCountries = $this->getDoctrine()
            ->getRepository('AppBundle:Country')
            ->findAllCountriesWithDependencies();

        foreach ($allCountries as $currentCountry) {
            if (in_array($currentCountry->getName(), $potOne)) {
                $potOneCountries[] = $currentCountry;

            } elseif (in_array($currentCountry->getName(), $potTwo)) {
                $potTwoCountries[] = $currentCountry;

            } elseif (in_array($currentCountry->getName(), $potThree)) {
                $potThreeCountries[] = $currentCountry;

            } elseif (in_array($currentCountry->getName(), $potFour)) {
                $potFourCountries[] = $currentCountry;
            }

        }

        return [

            'pot_one' => $potOneCountries,
            'pot_two' => $potTwoCountries,
            'pot_three' => $potThreeCountries,
            'pot_four' => $potFourCountries,
        ];
    }
}
