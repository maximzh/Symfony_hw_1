<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 20:20
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TeamControllerTest extends AbstractController
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
                [200, "/team/ukraine"],
                [200, "/team/northern_ireland"],
                [200, "/team/czech-republic"],
                [404, "/team/_ukraine_"],
                [404, "/team/england2"],
                [404, "/team/12"],
                [302, "/team"],
                [302, "/team/"]
            ];
    }
}