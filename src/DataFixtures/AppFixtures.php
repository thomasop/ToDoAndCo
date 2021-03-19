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
        for ($i = 1; $i < 5; ++$i) {
            $task = new Task();
            $task->setTitle('titre task_'.$i);
            $task->setContent('contenu task_'.$i);
            $manager->persist($task);
        }

        for ($i = 1; $i < 5; ++$i) {
            $user = new User();
            $user->setUsername('Nom_'.$i);
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    'Test1234?'
                )
            );
            $user->setEmail('mail_'.$i.'@gmail.com');
            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
