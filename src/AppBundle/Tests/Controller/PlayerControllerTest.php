<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:42
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PlayerControllerTest extends AbstractController
{
    /**
     * @param $$expectedStatusCode
     * @param $url
     * @dataProvider showProvider
     */
    public function testShow($expectedStatusCode, $path)
    {
        $this->requestTest($expectedStatusCode, $path, 'GET');
    }

    public function showProvider()
    {
        return
            [
                [404, "/player/player6"],
                [404, "/player/player_"],
                [200, "/player/1"]
            ];
    }
}