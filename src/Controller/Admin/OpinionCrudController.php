<?php

namespace App\Controller\Admin;

use App\Entity\Opinion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OpinionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Opinion::class;
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
