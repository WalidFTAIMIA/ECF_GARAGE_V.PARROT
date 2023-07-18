<?php

namespace App\Controller;

use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpinionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/pages/opinion', name: 'app_opinion')]
    public function ajoutOpinion(Request $request): Response
    {
        $nameOpinion = $request->request->get('nameOpinion');
        $messageOpinion = $request->request->get('messageOpinion');

        $opinion = new Opinion();
        $opinion->setNameOpinion($nameOpinion);
        $opinion->setMessageOpinion($messageOpinion);

        // Vérifier si un utilisateur est connecté
        if ($this->getUser()) {
            $opinion->setUsers($this->getUser());
        }

        // Enregistrer l'opinion dans la base de données
        $this->entityManager->persist($opinion);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}

