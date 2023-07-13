<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\CarsCatalogueFactory;
use App\Factory\CarsFactory;
use App\Factory\OpinionFactory;
use App\Factory\ServiceFactory;
use App\Factory\UsersFactory;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
    
        
        CarsCatalogueFactory::createMany(1);
        CarsFactory::createMany(10);
        OpinionFactory::createMany(10);
        UsersFactory::createMany(1);
        ServiceFactory::createMany(10);


        $manager->flush();
    }
}
