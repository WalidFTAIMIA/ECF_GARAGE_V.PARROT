<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\Service;
use App\Entity\Times;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;



#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
       
    }
    
    #[Route('/admin', name: 'app_dashboard')]
    public function index(): Response
    {
        
        $url = $this->adminUrlGenerator
            ->setController(UsersCrudController::class)
            ->generateUrl();

        return $this->redirect($url);

        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }



    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion site');
    }

    // public function configureUserMenu(UserInterface $user): UserMenu
    // {
    //     return parent::configureUserMenu($user)
    //         ->setGravatarEmail($user->getEmail());
    // }

    //  public function configureAssets(): Assets
    //  {
    //      return Assets::new()->addCssFile('public/css/admin.css');
    //  }

   
  

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home','app_home');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa-solid fa-gauge');


        if ($this->isGranted('ROLE_ADMIN'))
        {
            yield MenuItem::subMenu('Menu', 'fas fa-bars')->setSubItems([
                MenuItem::linkToCrud('Employée', 'fa-solid fa-user', Users::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus',  Users::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Horaire d\'ouverture', 'fa-solid fa-clock', Times::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus',  Times::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Services', 'fa-solid fa-truck-fast', Service::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus',  Service::class)->setAction(Crud::PAGE_NEW),
               
                    MenuItem::linkToCrud('Car','fa-solid fa-truck-fast', Cars::class),
                    MenuItem::linkToCrud('Ajouter', 'fas fa-plus',  Cars::class)->setAction(Crud::PAGE_NEW)
                
            ]);
            
        }
        // if ($this->isGranted('ROLE_EMPLOYER'))
        // {
        //     yield MenuItem::subMenu('Menu', 'fas fa-bars')->setSubItems([
        //         MenuItem::linkToCrud('Car','fa-solid fa-truck-fast', Cars::class),
        //         MenuItem::linkToCrud('Ajouter', 'fas fa-plus',  Users::class)->setAction(Crud::PAGE_NEW),
        //     ]);
        // }
        
    }

}
