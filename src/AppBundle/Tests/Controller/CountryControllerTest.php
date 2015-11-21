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

    /**
     * @param $statusCode
     * @param $url
     * @dataProvider showProvider
     */
    public function testShow($statusCode, $url)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $url);
        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

    }

    public function showProvider()
    {
        return
            [
                [200, "/country/ukraine"],
                [200, "/country/republic_of_ireland"],
                [200, "/country/czech-republic"],
                [302, "/country/"],
                [302, "/country"],
                [404, "/country/_ukraine_"],
                [404, "/country/eng1and2"],
                [404, "/country/12"]
        ];
    }
}