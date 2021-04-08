<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
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
    }

    public function testRemoveTask()
	{
		$user = new User();
		$task = new Task();

		$user->addTask($task);
		$this->assertEquals($task, $user->getTasks()[0]);

		$user->removeTask($task);
		$this->assertEquals([], $user->getTasks()->toArray());
	}
}
