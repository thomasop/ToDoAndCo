<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    /**
     * Test User Entity.
     *
     * @return void
     */
    public function testUser()
    {
        $task = new Task();
        $task->setTitle('testtitle');
        $task->setContent('testcontent');
        $task->setCreatedAt(new \DateTime());
        $this->assertEquals(date('Y-m-d H:i:s'), $task->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('testtitle', $task->getTitle());
        $this->assertEquals('testcontent', $task->getContent());
        $this->assertEquals(false, $task->IsDone());
        $this->assertEquals(false, $task->toggle(false));

        //self::bootKernel();
        //$error = self::$container->get('validator')->validate($task);
        //$this->assertCount(0, $error);
    }
}
