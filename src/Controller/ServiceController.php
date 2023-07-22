<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service', methods: ['GET'])]
    public function service(ServiceRepository $serviceRepo, TimesRepository $timesRepo): Response
    {
        $openingHours = $timesRepo->findAll();

        return $this->render('pages/service/service.html.twig', [
            'services' => $serviceRepo->findAll(),
            'openingHours' => $openingHours,
        ]);
    }
}