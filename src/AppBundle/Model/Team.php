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
    protected $slug;
    protected $players;
    protected $coaches;
    protected $lastGames;

    public function __construct($name)
    {
        $this->name = ucfirst(strtolower($name));


        $arr = explode('_', $this->name);
        foreach ($arr as &$value) {
            $value = ucfirst($value);
        }
        $this->name = implode(' ', $arr);

        $this->slug = $this->name;
        $this->slug = strtolower($this->slug);
        $this->slug = str_replace(' ', '_', $this->slug);

        $this->players = [];
        $faker = Factory::create();

        for($i = 1; $i <= 15; $i++ ) {

            $this->players[] = new Player($faker->firstNameMale.' '.$faker->lastName);
        }

        $this->coaches = [];
        for($i = 1; $i <=4; $i++) {
            $this->coaches[] = $faker->firstNameMale.' '.$faker->lastName;
        }

        $this->lastGames = [];
        $i = 0;
        while(++$i <= 5) {
          $this->lastGames[] = new Game($this->name, $faker->country);
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

    public function getCoaches()
    {
        return $this->coaches;
    }

    public function getLastGames()
    {
        return $this->lastGames;
    }

}