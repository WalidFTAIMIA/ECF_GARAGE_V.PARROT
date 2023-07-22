<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsCatalogueController extends AbstractController
{
    #[Route('/carscatalogue', name: 'app_carscatalogue', methods: ['GET'])]
    public function index(CarsRepository $carsRepository, TimesRepository $timesRepo): Response
    {
        $openingHours = $timesRepo->findAll();
        
        return $this->render('pages/cars/carscatalogue.html.twig', [
            'cars' => $carsRepository->findAll(),
            'openingHours' => $openingHours,
        ]);
    }
}