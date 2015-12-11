<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Country;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;

class FixturesLoader extends DataFixtureLoader
{
    /**
     * Returns an array of file paths to fixtures
     *
     * @return array<string>
     */
    protected function getFixtures()
    {
        $env = $this->container->get('kernel')->getEnvironment();
        if ($env == 'test') {
            return [
                __DIR__ . '/DataForTests/tags.yml',
                __DIR__ . '/DataForTests/categories.yml',
                __DIR__ . '/DataForTests/users.yml',
            ];
        }
        return [
           // __DIR__ . '/Data/players.yml',
           // __DIR__ . '/Data/coaches.yml',
            __DIR__ . '/Data/fixtures.yml',
        ];
    }

    public function createSlug($name)
    {
        $slug = strtolower($name);
        $slug = str_replace(' ', '_', $slug);

        return $slug;
    }

    public function createFlag($slug)
    {
        $flag = '/pictures/'.$slug.'.png';

        return $flag;
    }

}