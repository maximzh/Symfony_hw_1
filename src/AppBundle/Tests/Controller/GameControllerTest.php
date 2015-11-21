<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:51
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class GameControllerTest extends AbstractController
{
    /**
     *
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