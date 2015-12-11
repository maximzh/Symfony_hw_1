<?php
/**
 * Created by PhpStorm.
 * User: fumus
 * Date: 21.11.15
 * Time: 22:53
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestBaseWeb;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AbstractController extends TestBaseWeb
{

    protected function requestTest($expectedStatusCode, $path, $method = 'GET')
    {
        $client = static::createClient();

        $crawler = $client->request($method, $path);

        $this->assertEquals(
            $expectedStatusCode,
            $client->getResponse()->getStatusCode(),
            sprintf(
                'We expected that uri "%s" will return %s status code, but had received %d',
                $path,
                $expectedStatusCode,
                $client->getResponse()->getStatusCode()
            )
        );

        return $crawler;
    }
}