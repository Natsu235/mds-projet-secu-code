<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Utilisateur par défaut
        $defaultUser = new User();
        $defaultUser->setFirstName('Dorian');
        $defaultUser->setLastName('PILORGE');
        $defaultUser->setEmail('dorian.pilorge@symfony.org');
        $defaultUser->setPassword($this->encoder->encodePassword($defaultUser, 'password'));
        $defaultUser->setRoles(array('ROLE_USER','ROLE_ADMIN'));
        $manager->persist($defaultUser);

        // Génération d'utilisateurs
        $faker = Factory::create('Fr-fr');

        for ($i=0; $i < 15; $i++) { 
            $user = new User();
            $user->setFirstName($faker->firstname);
            $user->setLastName($faker->firstname);
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->encodePassword($user, 'password'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
