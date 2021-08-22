<?php

namespace App\DataFixtures;

use App\Entity\Contacts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AddessesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $facker = Factory::create('en_US');
        for ($i=0; $i < 300; $i++) { 
            $contact = new Contacts();
            $firstName = (($i % 3) == 0) ? $facker->firstNameMale : $facker->firstNameFemale;
            $lastName = $facker->lastName;
            $contact->setFirstname($lastName)
                    ->setLastname($firstName);
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
