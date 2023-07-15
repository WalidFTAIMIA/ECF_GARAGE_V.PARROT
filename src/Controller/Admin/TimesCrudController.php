<?php

namespace App\Controller\Admin;

use App\Entity\Times;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TimesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Times::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
       
        return $crud
            ->setEntityLabelInPlural('Horaire d\'ouverture')
            ->setEntityLabelInSingular('Horaire d\'ouverture');
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}