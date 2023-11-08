<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\CarsRepository;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_carscatalogue', methods: ['GET'])]
    public function index(CarsRepository $carsRepository, TimesRepository $timesRepo, Request $request, PaginatorInterface $paginator): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchForm::class, $searchData);
        $form->handleRequest($request);

        // Retrieve both price and kilometer ranges
        [$prixmin, $prixmax, $kmmin, $kmmax, $yearmin, $yearmax] = $carsRepository->findMinMax($searchData);

        $pagination = $paginator->paginate(
            $carsRepository->findSearch($searchData),
            $request->query->getInt('page', 1),
            6
        );
        $openingHours = $timesRepo->findAll();

        return $this->render('pages/cars/carscatalogue.html.twig', [
            'cars' => $pagination,
            'openingHours' => $openingHours,
            'form' => $form->createView(),
            'prixmin' => $prixmin,
            'prixmax' => $prixmax,
            'kmmin' => $kmmin, 
            'kmmax' => $kmmax,
            'yearmin' => $yearmin,
            'yearmax' => $yearmax

        ]);
    }

    #[Route('/cars/{id}', name: 'app_cars', methods: ['GET'])]
    public function show(CarsRepository $carsRepository, TimesRepository $timesRepo, int $id): Response
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
