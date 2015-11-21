<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends AbstractController
{
    public function testIndex()
    {
        $this->requestTest(200, "/", 'GET');

        $client = static::createClient();

        $crawler = $client->request("GET", "/");

        $this->assertContains('UEFA EURO 2016 FRANCE', $crawler->filter('h1')->text());
    }
}
