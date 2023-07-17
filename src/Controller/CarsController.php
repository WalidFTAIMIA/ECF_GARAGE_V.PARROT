<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_cars', methods: ['GET'])]
    public function index(CarsRepository $carsRepos): Response
    {
        return $this->render('pages/cars.html.twig', [
            'cars' => $carsRepos->findAll()
        ]);
    }
}
