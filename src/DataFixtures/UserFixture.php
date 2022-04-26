<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements FixtureGroupInterface
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->encoder = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User;
        $user->setEmail('admin@gmail.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $plainPassword = "pass";
        $pass = $this->encoder->hashPassword($user, $plainPassword);
        $user->setPassword($pass);
        $manager->persist($user);


        $user = new User;
        $user->setEmail('user@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $plainPassword ="pass";
        $pass = $this->encoder->hashPassword($user, $plainPassword);
        $user->setPassword($pass);
        $manager->persist($user);


        $manager->flush();
    }

    public static function getGroups() : array
    {
        return ['user'];
    }
}
