<?php

namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    public function testIndex()
    {
        $this->client = static::createClient();

        $this->client->request('GET', '/');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }
}
