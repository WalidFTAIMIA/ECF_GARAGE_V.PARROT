<?php

namespace App\Controller;


use App\Repository\OpinionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]  // methods: ['GET']) => créer un systhéme de sécurity url
    public function home(OpinionRepository $opinionRepo): Response
    {
        $opinions = $opinionRepo->findall();
        
        return $this->render('pages/home.html.twig', [
            'opinions' => $opinions,
        ]);
    }
}
