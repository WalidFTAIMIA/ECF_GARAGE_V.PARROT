<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service', methods: ['GET'])]
    public function service(ServiceRepository $serviceRepo): Response
    {
        
        return $this->render('pages/service.html.twig', [
            'service'=>$serviceRepo->findAll()
             
            
        ]);
    }
}

