<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]  // methods: ['GET']) => créer un systhéme de sécurity url
    public function home(): Response
    {
        return $this->render('pages/home.html.twig');
    }
}
