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

        $crawler = $this->client->request('GET', '/users');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testCreateAction()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/users/create');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $form = $crawler->selectButton('submit')->form();
        $form['user[username]'] = rand(0, 10000).'Testuser';
        $form['user[password][first]'] = 'Tpassword';
        $form['user[password][second]'] = 'Tpassword';
        $form['user[email]'] = rand(0, 10000).'email@gmail.com';
          
        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        static::assertResponseIsSuccessful();
    }

    public function testEditAction()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/users/5/edit');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        $form = $crawler->selectButton('submit')->form();
        $form['user[username]'] = rand(0, 10000).'Testuser';
        $form['user[password][first]'] = 'Tpassword';
        $form['user[password][second]'] = 'Tpassword';
        $form['user[email]'] = rand(0, 10000).'email@gmail.com';
          
        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        static::assertResponseIsSuccessful();
    }
}
