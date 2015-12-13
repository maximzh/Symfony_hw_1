<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:20
 */

namespace AppBundle\Tests\Controller;


class TeamControllerTest extends AbstractController
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
                [302, "/team"],
                [302, "/team/"],
                [200, "team/ukraine"]
            ];
    }
}