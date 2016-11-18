<?php

namespace Acme\FishBlockBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PropoSerieControllerTest extends WebTestCase
{
    public function testAddserie()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/proposer');
    }

}
