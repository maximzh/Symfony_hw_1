<?php

namespace AppBundle\Tests\Controller;


class DefaultControllerTest extends AbstractController
{
    public function testIndex()
    {

        $client = static::createClient();

        $crawler = $client->request("GET", "/");

        $this->assertContains('UEFA EURO 2016', $crawler->filter('h1')->text());
    }
}
