<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 26.11.15
 * Time: 12:56
 */

namespace AppBundle\Model;


use Faker\Factory;

class Country
{
    protected $name;
    protected $requestFormatName;
    protected $nationalTeam;
    protected $uefaRank;
    protected $flag;

    public function __construct($name)
    {
        $faker = Factory::create();
        $this->name = ucfirst(strtolower($name));
        $arr = explode('_', $this->name);
        foreach($arr as &$value) {
            $value = ucfirst($value);
        }
        $this->name = implode(' ', $arr);

        $this->requestFormatName = strtolower($this->name);
        $this->requestFormatName = str_replace(' ', '_', $this->requestFormatName);

        $this->uefaRank = $faker->numberBetween(1, 54);

        $this->flag = '/pictures/'.$this->requestFormatName.'.png';

    }

    public function getName()
    {
        return $this->name;
    }

    public function getUefaRank()
    {
        return $this->uefaRank;
    }

    public function getRequestFormatName()
    {
        return $this->requestFormatName;
    }

    public function getFlag()
    {
        return $this->flag;
    }
}