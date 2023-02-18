<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor = new Actor();
        $actor->setname("Uros Rajkovic");
        $manager->persist($actor);

        $actor1 = new Actor();
        $actor1->setname("Sara Rajkovic");
        $manager->persist($actor1);

        $actor2 = new Actor();
        $actor2->setname("Andrea Rajkovic");
        $manager->persist($actor2);

        $actor3 = new Actor();
        $actor3->setname("Sonja Rajkovic");
        $manager->persist($actor3);
        $manager->flush();

        $this->addReference('actor_1',$actor);
        $this->addReference('actor_2',$actor1);
        $this->addReference('actor_3',$actor2);
        $this->addReference('actor_4',$actor3);
    }
}
