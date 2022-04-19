<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtisteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        $artiste = new Artiste();
        $artiste->setLastname('Eastwood');
        $artiste->setFirstname('Clint');
        $artiste->setBirthdate(new \DateTime('31-05-1930'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('clint.jpg');

        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setLastname('Cooper');
        $artiste->setFirstname('Bradley');
        $artiste->setBirthdate(new \DateTime('05-01-1975'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('cooper.jpg');

        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setLastname('Miller');
        $artiste->setFirstname('Sienna');
        $artiste->setBirthdate(new \DateTime('28-12-1981'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('sienna.jpg');

        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setLastname('Ford');
        $artiste->setFirstname('Harrison');
        $artiste->setBirthdate(new \DateTime('13-07-1942'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('ford.jpg');

        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setLastname('Hamill');
        $artiste->setFirstname('Mark');
        $artiste->setBirthdate(new \DateTime('25-09-1951'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('hamill.jpg');

        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setLastname('Spielberg');
        $artiste->setFirstname('Steven');
        $artiste->setBirthdate(new \DateTime('18-12-1946'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('spielberg.jpg');

        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setLastname('Lucas');
        $artiste->setFirstname('George');
        $artiste->setBirthdate(new \DateTime('14-05-1944'));
        $artiste->setUpdatedAt(new \DateTimeImmutable('now'));
        $artiste->setImageName('lucas.jpg');

        $manager->persist($artiste);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
