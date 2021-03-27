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
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $this->client->submit($form, [
            'username' => 'UserAnon',
            'password' => 'UserAnon',
        ]);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(1, $crawler->filter('h1')->count());
        $this->client->request('GET', '/');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
