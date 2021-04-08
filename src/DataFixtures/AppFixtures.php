<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        $userTest = new User();
        $userTest->setUsername('test');
        $userTest->setRoles(['ROLE_ADMIN']);
        $userTest->setPassword(
            $this->passwordEncoder->encodePassword(
                    $userTest,
                    'Test1234?'
                )
        );
        $userTest->setEmail('mail@gmail.com');
        $manager->persist($userTest);

        for ($i = 1; $i < 5; ++$i) {
            $task = new Task();
            $task->setTitle('titre task_'.$i);
            $task->setContent('contenu task_'.$i);
            $task->setUser($userTest);
            $manager->persist($task);
        }

        $user = new User();
        $user->setUsername('User');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'User'
            )
        );
        $user->setEmail('user@gmail.com');

        $manager->persist($user);

        $userAnon = new User();
        $userAnon->setUsername('UserAnon');
        $userAnon->setRoles(['ROLE_USER']);
        $userAnon->setPassword(
            $this->passwordEncoder->encodePassword(
                $userAnon,
                'UserAnon'
            )
        );
        $userAnon->setEmail('userAnon@gmail.com');

        $manager->persist($userAnon);
        $manager->flush();
    }
}
