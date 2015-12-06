<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 19:42
 */

namespace AppBundle\Tests\Controller;


class CountryControllerTest extends AbstractController
{

    /**
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
                [302, "/country/"],
                [302, "/country"],
            ];
    }
}