<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 19:42
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CountryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/country');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/country/');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }


    /**
     * @param $code
     * @param $url
     * @dataProvider showProvider
     */
    public function testShow($code, $url)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $url);
        $this->assertEquals($code, $client->getResponse()->getStatusCode());

    }

    public function showProvider()
    {
        return
            [
                [200, "/country/ukraine"],
                [200, "/country/republic_of_ireland"],
                [200, "/country/czech-republic"],
                [404, "/country/_ukraine_"],
                [404, "/country/england2"],
                [404, "/country/12"]
        ];
    }
}