<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\Contact;
use App\Entity\Opinion;
use App\Entity\Service;
use App\Entity\Times;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'app_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();

        if (in_array('ROLE_ADMIN', $roles)) {
            $url = $this->adminUrlGenerator
                ->setController(UsersCrudController::class)
                ->generateUrl();

            return $this->redirect($url);
        }

        if (in_array('ROLE_EMPLOYER', $roles)) {
            $url = $this->adminUrlGenerator
                ->setController(CarsCrudController::class)
                ->generateUrl();

            return $this->redirect($url);
        }

        // Si aucun des rôles ne correspond, redirection vers la page de  connexion
        return $this->redirectToRoute('app_login');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion site');
    }

    #[IsGranted('ROLE_ADMIN', 'ROLE_EMPLOYER')]
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa-solid fa-gauge');

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::subMenu('Menu (Admin)', 'fas fa-bars')->setSubItems([
                MenuItem::linkToCrud('Employée', 'fa-solid fa-user', Users::class),
                MenuItem::linkToCrud('Ajouter Employée', 'fas fa-plus', Users::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Horaire d\'ouverture', 'fa-solid fa-clock', Times::class),
                MenuItem::linkToCrud('Ajouter Horaire', 'fas fa-plus', Times::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Services', 'fa-solid fa-truck-fast', Service::class),
                MenuItem::linkToCrud('Ajouter Service', 'fas fa-plus', Service::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Car', 'fa-solid fa-truck-fast', Cars::class),
                MenuItem::linkToCrud('Ajouter Car', 'fas fa-plus', Cars::class)->setAction(Crud::PAGE_NEW),
            ]);
            
        }

        if ($this->isGranted('ROLE_EMPLOYER')) {
            yield MenuItem::subMenu('Menu (Employées)', 'fas fa-bars')->setSubItems([
                MenuItem::linkToCrud('Car', 'fa-solid fa-truck-fast', Cars::class),
                MenuItem::linkToCrud('Ajouter Car', 'fas fa-plus', Cars::class)->setAction(Crud::PAGE_NEW),
            ]);
        }
        yield MenuItem::linkToCrud('Avis Client', 'fas fa-comment', Opinion::class);
        yield MenuItem::linkToCrud('Message', 'fa-solid fa-message', Contact::class);
    }   
}