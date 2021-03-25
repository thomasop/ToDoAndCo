<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
            $user->setUsername('test');
            $user->setRole("ROLE_ADMIN");
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    'Test1234?'
                )
            );
            $user->setEmail('mail@gmail.com');
            $manager->persist($user);

        for ($i = 1; $i < 5; ++$i) {
            $task = new Task();
            $task->setTitle('titre task_'.$i);
            $task->setContent('contenu task_'.$i);
            $task->setUser($user);
            $manager->persist($task);
        }

        $user = new User();
        $user->setUsername('Nomtest');
        $user->setRole("ROLE_ADMIN");
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'Test1234?'
            )
        );
        $user->setEmail('mailtest@gmail.com');
        $manager->persist($user);

        $manager->flush();
    }
}
