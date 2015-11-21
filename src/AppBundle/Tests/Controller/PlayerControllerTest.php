<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:42
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PlayerControllerTest extends WebTestCase
{
    /**
     * @param $code
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
                [200, "/player/lukaku"],
                [200, "/player/andriy_yarmolenko"],
                [200, "/player/czech-republic"],
                [302, "/player/"],
                [302, "/player"],
                [404, "/player/player6"],
                [404, "/player/player_"],
                [404, "/country/152"]
            ];
    }
}