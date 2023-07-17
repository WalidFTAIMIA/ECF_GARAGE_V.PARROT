<?php

namespace App\Controller;

use App\Repository\CarsCatalogueRepository;
use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsCatalogueController extends AbstractController
{
    #[Route('/carscatalogue', name: 'app_carscatalogue', methods: ['GET'])]
    public function carscatalogue(CarsRepository $carsRepo): Response
    {
        return $this->render('pages/carscatalogue.html.twig', [
            'cars' => $carsRepo->findAll(),
        ]);
    }

}
