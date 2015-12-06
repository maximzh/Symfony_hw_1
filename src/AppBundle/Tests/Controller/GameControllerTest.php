<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:51
 */

namespace AppBundle\Tests\Controller;


class GameControllerTest extends AbstractController
{
    /**
     *
     * @dataProvider showProvider
     * @param $expectedStatusCode
     * @param $path
     */
    public function testShow($expectedStatusCode, $path)
    {
        $this->requestTest($expectedStatusCode, $path, 'GET');
    }

    public function showProvider()
    {
        return
            [
                [302, "/game/"],
                [302, "/game"],
                [404, "/game/0002"],
                [404, "/game/abcd"],
                [404, "/game/2_game"],
            ];
    }
}