<?php

namespace App\Controller\Admin;

use App\Entity\Opinion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpinionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Opinion::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-pencil');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        $nameOpinion = TextField::new('nameOpinion', 'Nom');
        $messageOpinion = TextareaField::new('messageOpinion', 'Message');
        $approvedOpinion = BooleanField::new('approvedOpinion', 'Approuver');
        $users = AssociationField::new('users');

        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            return [$nameOpinion, $messageOpinion, $approvedOpinion, $users];
        } elseif ($pageName === Crud::PAGE_EDIT || $pageName === Crud::PAGE_NEW) {
            return [$nameOpinion, $messageOpinion, $approvedOpinion, $users];
        }
    }
}
