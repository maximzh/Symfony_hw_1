<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 27.11.15
 * Time: 1:14
 */

namespace AppBundle\Model;


use Faker\Factory;

class Game
{
    protected $id;
    protected $firstTeam;
    protected $secondTeam;
    protected $result;
    protected $startTime;
    protected $gameDate;

    public function __construct($firstTeam = null, $secondTeam = null, $id = null)
    {
        $faker = Factory::create();

        if (isset($firstTeam)) {
            $this->firstTeam = $firstTeam;
        }
        if (isset($secondTeam)) {
            $this->secondTeam = $secondTeam;
        }


        $this->id = $faker->numberBetween(1, 10000);

        $score = [];
        $score[] = $faker->numberBetween(0, 4);
        $score[] = $faker->numberBetween(0, 4);
        $this->result = $score;

        $this->gameDate = $faker->dateTimeBetween('-50 days', '+50 days');
        $this->startTime = $faker->time('H:i');

    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function setFirstTeam($firstTeam)
    {
        $this->firstTeam = $firstTeam;
    }


    public function setSecondTeam($secondTeam)
    {
        $this->secondTeam = $secondTeam;
    }


    public function getFirstTeam()
    {
        return $this->firstTeam;
    }


    public function getSecondTeam()
    {
        return $this->secondTeam;
    }


    public function getResult()
    {
        return $this->result;
    }


    public function getGameDate()
    {
        return $this->gameDate;
    }


    public function getStartTime()
    {
        return $this->startTime;
    }


    public function getId()
    {
        return $this->id;
    }

}