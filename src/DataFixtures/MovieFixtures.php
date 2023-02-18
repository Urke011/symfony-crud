<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle("Last night");
        $movie->setreleaseYear(2005);
        $movie->setdescription("In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.");
        $movie->setimagePath("https://www.yateo.com/blog/wp-content/uploads/2020/03/symfony.jpg");
        //add data for pivet table
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));
        $manager->persist($movie);


        $movie2 = new Movie();
        $movie2->setTitle("first night");
        $movie2->setreleaseYear(2011);
        $movie2->setdescription("In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.");
        $movie2->setimagePath("https://raw.githubusercontent.com/agungksidik/public-assets/master/logo/laravel-logo.png");
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));

        $manager->persist($movie2);

        $manager->flush();
    }
}
