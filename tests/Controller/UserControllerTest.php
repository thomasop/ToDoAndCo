<?php

namespace Tests\App\Controller;

use Symfony\Component\HTTPFoundation\Response;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    use FixturesTrait;

    private $client = null;
    
    public function setUp(): void
	{
        $fixtures = $this->loadFixtures([
            'App\DataFixtures\AppFixtures'
        ])->getReferenceRepository();
	}

    public function testListAction()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'test',
            'password' => 'Test1234?'
        ]);
        $crawler = $this->client->followRedirect();
       $this->assertEquals(1, $crawler->filter('h1')->count());
        $crawler = $this->client->request('GET', '/users');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testCreateAction()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'test',
            'password' => 'Test1234?'
        ]);
        $crawler = $this->client->followRedirect();
       $this->assertEquals(1, $crawler->filter('h1')->count());
        $crawler = $this->client->request('GET', '/users/create');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $form = $crawler->selectButton('Ajouter')->form();
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

        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'test',
            'password' => 'Test1234?'
        ]);
        $crawler = $this->client->followRedirect();
       $this->assertEquals(1, $crawler->filter('h1')->count());
        $crawler = $this->client->request('GET', '/users/2/edit');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]'] = 'Testedit';
        $form['user[password][first]'] = 'Test1234?';
        $form['user[password][second]'] = 'Test1234?';
        $form['user[email]'] = 'testok@gmail.com';
          
        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        static::assertResponseIsSuccessful();
    }
}
