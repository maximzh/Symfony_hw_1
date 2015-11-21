<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:51
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class GameControllerTest extends WebTestCase
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
                [200, "/game/12"],
                [200, "/game/2"],
                [302, "/game/"],
                [302, "/game"],
                [404, "/game/0002"],
                [404, "/game/abcd"],
                [404, "/game/2_game"]
            ];
    }
}