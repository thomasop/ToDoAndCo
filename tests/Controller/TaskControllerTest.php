<?php

namespace Tests\App\Controller;

use Symfony\Component\HTTPFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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

        $crawler = $this->client->request('GET', '/tasks/create');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
  
        $form = $crawler->selectButton('submit')->form();
        $form['task[title]'] = 'Test Super titre de tache';
        $form['task[content]'] = 'Test Contenu de la supertache blablabla.';
          
        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        static::assertResponseIsSuccessful();
    }

    public function testEditAction()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/tasks/12/edit');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        
        $form = $crawler->selectButton('submit')->form();
        $form['task[title]'] = 'Test Super titre de tache';
        $form['task[content]'] = 'Test Contenu de la supertache blablabla.';
        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        static::assertResponseIsSuccessful();
    }

    public function testToggleAction()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/tasks/12/toggle');
        static::assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }

    public function testDeleteAction()
    {
        $this->client = static::createClient();

        $test = $this->client->request('GET', '/tasks/12/delete');
        static::assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );
        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }
}
