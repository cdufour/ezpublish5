<?php

namespace Formation\ExampleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SuperControllerTest extends WebTestCase
{
    public function testDefault()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/default');
    }

}
