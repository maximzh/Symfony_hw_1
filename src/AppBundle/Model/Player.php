<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 25.11.15
 * Time: 23:51
 */

namespace AppBundle\Model;


use Faker\Factory;

class Player
{
    protected $name;
    protected $requestFormatName;
    protected $position;
    protected $squadNumber;
    protected $height;
    protected $weight;
    protected $dateOfBirth;

    public function __construct($name)
    {
        $this->name = str_replace('_', '\'', $name);
        $arr = explode('-', $this->name);
        foreach($arr as &$value) {
          $value = ucfirst($value);
        }
        $this->name = implode(' ', $arr);

        $this->requestFormatName = strtolower($this->name);
        $this->requestFormatName = str_replace(' ', '-', $this->requestFormatName);
        $this->requestFormatName = str_replace('\'', '_', $this->requestFormatName);

        $faker = Factory::create();

        $positions = array('Goal keeper', 'Defender', 'Midfielder', 'Forward');
        $this->position = $positions[array_rand($positions)];

        $this->squadNumber = $faker->numberBetween(1, 100);

        $this->height = $faker->numberBetween(165, 195);

        $this->weight = $faker->numberBetween(65, 90);

        $this->dateOfBirth = $faker->dateTimeBetween('-35 years', '-21 years');
    }


    public function getName()
    {
        return $this->name;
    }

    public function getRequestFormatName()
    {
        return $this->requestFormatName;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getSquadNumber()
    {
        return $this->squadNumber;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }


}