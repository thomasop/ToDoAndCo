<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;



class TaskTest extends KernelTestCase
{

    /**
     * Test User Entity
     *
     * @return void
     */
	public function testUser()
	{
        $task = new Task();
        $task->setTitle("testtitle");
		$task->setContent("testcontent");
		self::bootKernel();
		$error = self::$container->get('validator')->validate($task);
		$this->assertCount(0, $error);
	}
}