<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    /**
     * Test User Entity.
     *
     * @return void
     */
    public function testUser()
    {
        $user = new User();
        $user->setUsername('testname');
        $this->assertEquals('testname', $user->getUsername());
        $user->setPassword('testpassword');
        $this->assertEquals('testpassword', $user->getPassword());
        $user->setEmail('tdss33@hotmail.com');
        $this->assertEquals('tdss33@hotmail.com', $user->getEmail());

        $taskStub = $this->createMock(Task::class);
        $user->addTask($taskStub);
        $collection = $user->getTasks();
        $this->assertEquals(false, $collection->isEmpty());
        $user->removeTask($taskStub);
        $this->assertEquals(true, $collection->isEmpty());
        //self::bootKernel();
        //$error = self::$container->get('validator')->validate($user);
        //$this->assertCount(0, $error);
    }
}
