<?php

namespace App\Controller;

use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class OpinionController extends AbstractController
{
    private $entityManager;
    private $authorizationChecker;

    public function __construct(EntityManagerInterface $entityManager, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->entityManager = $entityManager;
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route('/pages/opinion', name: 'app_opinion')]
    public function ajoutOpinion(Request $request): Response
    {
        $nameOpinion = $request->request->get('nameOpinion');
        $messageOpinion = $request->request->get('messageOpinion');

        $opinion = new Opinion();
        $opinion->setNameOpinion($nameOpinion);
        $opinion->setMessageOpinion($messageOpinion);

        // Vérifier si l'utilisateur connecté a le rôle d'administrateur
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $opinion->setApprovedOpinion(true);
        } else {
            $opinion->setApprovedOpinion(false);
        }

        // Enregistrer l'opinion dans la base de données
        $this->entityManager->persist($opinion);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}

