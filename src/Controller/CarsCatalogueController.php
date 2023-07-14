<?php

namespace App\Controller;

use App\Repository\CarsCatalogueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsCatalogueController extends AbstractController
{
    #[Route('/carscatalogue', name: 'app_carscatalogue', methods: ['GET'])]
    public function carscatalogue(CarsCatalogueRepository $carsCatalogueRepo): Response
    {
        return $this->render('pages/carscatalogue.html.twig', [
            'carscatalogue' => $carsCatalogueRepo->findAll(),
        ]);
    }

}
