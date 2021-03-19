<?php
namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use PHPUnit\Framework\TestCase;

class SecurityControllerTest extends WebTestCase
{
    private $client = null;
  
    public function testSecurityIsUp()
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/login');
    
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
