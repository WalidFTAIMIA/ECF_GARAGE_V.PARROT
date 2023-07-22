<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\TimesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function __construct()
    {
    
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, TimesRepository $timesRepository, EntityManagerInterface $entityManager): Response
    {
        $openingHours = $timesRepository->findAll();

        // Création d'une nouvelle instance de l'entité Contact
        $contact = new Contact();

        // Traitement de la soumission du formulaire
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $message = $request->request->get('message');

            // Attribution des valeurs aux attributs de l'entité Contact
            $contact->setNameContact($name);
            $contact->setEmailContact($email);
            $contact->setPhoneContact($phone);
            $contact->setMessageContact($message);

            // Enregistrement du contact en base de données
            $entityManager->persist($contact);
            $entityManager->flush();

          

            // Redirection vers la même page
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('pages/contact/contact.html.twig', [
            'openingHours' => $openingHours,
        ]);
    }
}