<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\CarsRepository;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_carscatalogue', methods: ['GET'])]
    public function index(CarsRepository $carsRepository, TimesRepository $timesRepo): Response
    {   
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $openingHours = $timesRepo->findAll();

        return $this->render('pages/cars/carscatalogue.html.twig', [
            'cars' => $carsRepository->findAll(),
            'openingHours' => $openingHours,
            'form' => $form->createView()
        ]);
    }

    #[Route('/cars/{id}', name: 'app_cars', methods: ['GET'])]
    public function show(CarsRepository $carsRepository,TimesRepository $timesRepo ,int $id): Response
    {
        $car = $carsRepository->find($id);
        $openingHours = $timesRepo->findAll();

        if (!$car) {
            throw $this->createNotFoundException('La voiture n\'existe pas.');
        }

        return $this->render('pages/cars/cars.html.twig', [
            'car' => $car,
            'openingHours' => $openingHours
        ]);
    }
}