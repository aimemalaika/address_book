<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $password = $this->encoder->encodePassword($user, 'Aime1995@');
        $user->setUsername("aimemalaika")
            ->setPassword($password);
        $manager->persist($user);     

        $manager->flush();
    }
}
