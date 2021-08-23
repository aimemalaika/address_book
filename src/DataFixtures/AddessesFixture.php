<?php

namespace App\DataFixtures;

use App\Entity\Contacts;
use App\Entity\Emails;
use App\Entity\Telephone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AddessesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $facker = Factory::create('en_US');
        for ($i=0; $i < 200; $i++) { 
            $contact = new Contacts();
            $firstName = (($i % 3) == 0) ? $facker->firstNameMale : $facker->firstNameFemale;
            $lastName = $facker->lastName;
            $contact->setFirstname($lastName)
                    ->setLastname($firstName);
            $manager->persist($contact);

            for($j= 0; $j < rand(3,8); $j++){
                $email = new Emails();
                $email->setEmailaddress($facker->freeEmail)
                        ->setContact($contact);
                $manager->persist($email);

                $tel = new Telephone();
                $tel->setTelephone($facker->e164PhoneNumber)
                        ->setContact($contact);
                $manager->persist($tel);
            }
        }

        $manager->flush();
    }
}
