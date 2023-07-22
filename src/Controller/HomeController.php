<?php

namespace App\Controller;

use App\Repository\OpinionRepository;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function home(OpinionRepository $opinionRepo,TimesRepository $timesRepo): Response
    {
        $approvedOpinions = $opinionRepo->findApprovedOpinions();
        $openingHours = $timesRepo->findAll();


        return $this->render('pages/accueil/home.html.twig', [
            'opinions' => $approvedOpinions,
            'openingHours' => $openingHours,
        ]);
    }
}