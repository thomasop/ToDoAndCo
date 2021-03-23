<?php

namespace Tests\App\Controller;

use Symfony\Component\HTTPFoundation\Response;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;

class TaskControllerTest extends WebTestCase
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

        $test = $this->client->request('GET', '/tasks');
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
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testEditAction()
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'test',
            'password' => 'Test1234?'
        ]);
        $crawler = $this->client->followRedirect();
       $this->assertEquals(1, $crawler->filter('h1')->count());
        $crawler = $this->client->request('GET', '/tasks/4/edit');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        
        $form = $crawler->selectButton('submit')->form();
        $form['task[title]'] = 'Test edition';
        $form['task[content]'] = 'Test edition.';
        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testToggleAction()
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'test',
            'password' => 'Test1234?'
        ]);
        $crawler = $this->client->followRedirect();
       $this->assertEquals(1, $crawler->filter('h1')->count());
        $crawler = $this->client->request('GET', '/tasks/4/toggle');
        static::assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteAction()
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'test',
            'password' => 'Test1234?'
        ]);
        $crawler = $this->client->followRedirect();
       $this->assertEquals(1, $crawler->filter('h1')->count());
        $crawler = $this->client->request('GET', '/tasks/4/delete');
        static::assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );
        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
