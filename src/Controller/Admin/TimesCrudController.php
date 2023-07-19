<?php

namespace App\Controller\Admin;

use App\Entity\Times;
use App\Repository\TimesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Times::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Horaires d\'ouverture')
            ->setEntityLabelInSingular('Horaire d\'ouverture');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('day', 'Jour'),
            TextField::new('morningOpeningTime', 'Heure d\'ouverture (matin)'),
            TextField::new('morningClosingTime', 'Heure de fermeture (matin)'),
            TextField::new('afternoonOpeningTime', 'Heure d\'ouverture (après-midi)'),
            TextField::new('afternoonClosingTime', 'Heure de fermeture (après-midi)'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-user')->addCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->addCssClass('btn btn-outline-danger');
            });
    }

    /**
     * @Route("/opening-hours", name="opening_hours")
     */
    public function displayOpeningHours(TimesRepository $timesRepository): Response
    {
        $openingHours = $timesRepository->findAll();

        return $this->render('_footer.html.twig', [
            'openingHours' => $openingHours,
        ]);
    }
}
