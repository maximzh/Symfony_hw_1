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
                __DIR__ . '/DataForTests/fixtures.yml',
            ];
        }
        return [
            __DIR__ . '/Data/fixtures.yml',
        ];
    }

    public function createSlug($name)
    {
        $name = trim($name);
        $slug = strtolower($name);
        $slug = str_replace(' ', '_', $slug);

        return (string) $slug;
    }

    public function createFlag($slug)
    {
        $flag = '/pictures/'.$slug.'.png';

        return $flag;
    }

}