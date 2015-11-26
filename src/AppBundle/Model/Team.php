<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.11.15
 * Time: 0:36
 */

namespace AppBundle\Model;


use Faker\Factory;

class Team
{
    protected $name;
    protected $players;
    protected $coaches;

    public function __construct($name)
    {
        $this->name = $name;

        $this->players = [];
        $faker = Factory::create();

        for($i = 1; $i <= 20; $i++ ) {

            $this->players[] = new Player($faker->firstNameMale.' '.$faker->lastName);
        }
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getName()
    {
        return $this->name;
    }

}