<?php

namespace App\Controller\Admin;

use App\Entity\CarsCatalogue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarsCatalogueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarsCatalogue::class;
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
