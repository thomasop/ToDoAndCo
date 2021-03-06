<?php

namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class TaskControllerTest extends WebTestCase
{
    private $client = null;

    public function testListAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/tasks');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }

    public function testCreateAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/tasks/create');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }

    public function testEditAction()
    {
        $this->client = static::createClient();

        $this->client->request('GET', '/tasks/5/edit');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
          );
    }

    public function testToggleAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/tasks/5/toggle');
        static::assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
          );
    }

    public function testDeleteAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/tasks/5/delete');
        static::assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
          );
    }
}