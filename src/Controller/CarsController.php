<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_carscatalogue', methods: ['GET'])]
    public function index(CarsRepository $carsRepository): Response
    {
        return $this->render('pages/carscatalogue.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }

    #[Route('/cars/{id}', name: 'app_cars', methods: ['GET'])]
    public function show(CarsRepository $carsRepository, int $id): Response
    {
        $car = $carsRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException('La voiture n\'existe pas.');
        }

        return $this->render('pages/cars.html.twig', [
            'car' => $car
        ]);
    }
}
