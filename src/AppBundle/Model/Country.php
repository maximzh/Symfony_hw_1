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
    protected $slug;
    protected $uefaRank;
    protected $flag;
    protected $shortHistory;
    protected $firstMembership;
    protected $nationalTeamFoundedAt;

    public function __construct($name)
    {
        $faker = Factory::create();
        $this->name = ucfirst(strtolower($name));

        if (substr_count($this->name, '_') > 0) {

            $arr = explode('_', $this->name);
            foreach ($arr as &$value) {
                $value = ucfirst($value);
            }
            $this->name = implode(' ', $arr);


        } elseif (substr_count($this->name, ' ') > 0) {

            $arr = explode(' ', $this->name);
            foreach ($arr as &$value) {
                $value = ucfirst($value);
            }
            $this->name = implode(' ', $arr);
        }


        $this->slug = $this->name;
        $this->slug = strtolower($this->slug);
        $this->slug = str_replace(' ', '_', $this->slug);

        $this->uefaRank = $faker->numberBetween(1, 54);

        $this->flag = '/pictures/'.$this->slug.'.png';

        $this->shortHistory = $faker->text(1000);

        $this->firstMembership = $faker->year;

        $this->nationalTeamFoundedAt = $faker->year;

    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUefaRank()
    {
        return $this->uefaRank;
    }

    public function getFlag()
    {
        return $this->flag;
    }

    public function getShortHistory()
    {
        return $this->shortHistory;
    }

    public function getFirstMembership()
    {
        return $this->firstMembership;
    }

    public function getNationalTeamFoundedAt()
    {
        return $this->nationalTeamFoundedAt;
    }

}