<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('carsbrand', 'Marque'),
            TextField::new('carsmodel', 'Model'),
            NumberField::new('carskm'),
            // ImageField::new('carspicture','Image')
            //     ->setBasePath('images')
            //     ->setUploadDir('public/images'),
            MoneyField::new('carsprice','Prix')
                ->setCurrency('EUR'),
            DateField::new('carsyear','Année'),
            TextField::new('carsenergy', 'Carburant'), 
            ImageField::new('picture', 'Image')
                ->setBasePath('images')
                ->setUploadDir('public/images'),
        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions 
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW,function(Action $action){
                return $action->setIcon('fa fa-user')->addCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT,function(Action $action){
                return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL,function(Action $action){
                return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE,function(Action $action){
                return $action->setIcon('fa fa-trash')->addCssClass('btn btn-outline-danger');
            });
    }
    
}
