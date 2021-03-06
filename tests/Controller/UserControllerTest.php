<?php

namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class UserControllerTest extends WebTestCase
{
    private $client = null;

    public function testListAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/users');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }

    public function testCreateAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/users/create');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }

    public function testEditAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/users/5/edit');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }
}