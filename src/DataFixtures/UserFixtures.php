<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Pablo');
        $user->setMiddleName('Calebe Cordeiro');
        $user->setLastName('Camara');
        $user->setEmail('pablo@camara.pt');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'1234'));
        $manager->persist($user);

        $manager->flush();
    }
}
