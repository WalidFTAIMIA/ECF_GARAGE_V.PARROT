<?php

namespace App\Controller\Admin;

use App\Entity\Times;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TimesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Times::class;
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
