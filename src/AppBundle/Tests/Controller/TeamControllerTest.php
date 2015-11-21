<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:20
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TeamControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/team/');
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
                [200, "/team/ukraine"],
                [200, "/team/northern_ireland"],
                [200, "/team/czech-republic"],
                [404, "/team/_ukraine_"],
                [404, "/team/england2"],
                [404, "/team/12"]
            ];
    }
}