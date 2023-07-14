<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiceCrudController extends AbstractCrudController
{
   

    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), 
            ImageField::new('picture', 'Image')
                ->setBasePath('images')
                ->setUploadDir('public/images'),
            TextField::new('title', 'Titre'),
            TextEditorField::new('description' , 'Détails'),
        ];
    }
    
  
}
