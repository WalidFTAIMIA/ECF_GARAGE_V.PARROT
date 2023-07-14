<?php

namespace App\DataFixtures;

use App\Entity\CarsCatalogue;
use App\Entity\Service;
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
         $carscatalogue = new CarsCatalogue();
         $carscatalogue->setPictureCarsCatalogue('Picture');
         $carscatalogue ->setPrice('40000');
         $carscatalogue ->setTitle('Mercedes');

         $manager->persist($carscatalogue);
        
        $service= new Service();
        $service->setTitle('Pneu');
        $service ->setDescription('Réparation des pneus');
        
        $manager->persist($service);

        
        //  CarsCatalogueFactory::createMany(1);
        //  CarsFactory::createMany(10);
        //  OpinionFactory::createMany(10);
        //  UsersFactory::createMany(1);
        //  ServiceFactory::createMany(10);

        

        $manager->flush();
    }
}
