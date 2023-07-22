<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Contacts')
            ->setEntityLabelInSingular('Contact');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW) 
            ->remove(Crud::PAGE_INDEX, Action::EDIT) 
            ->remove(Crud::PAGE_INDEX, Action::DELETE) 
            ->add(Crud::PAGE_INDEX, Action::DETAIL) 
            ->add(Crud::PAGE_INDEX, Action::DELETE) 
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye'); 
            });
    }

    public function configureFields(string $pageName): iterable
    {
        $nameContact = TextField::new('nameContact', 'Nom');
        $emailContact = EmailField::new('emailContact', 'Email');
        $phoneContact = TextField::new('phoneContact', 'Téléphone');
        $messageContact = TextareaField::new('messageContact', 'Message');
        $users = AssociationField::new('users', 'Utilisateur')->hideOnForm();

        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            return [$nameContact, $emailContact, $messageContact, $phoneContact, $users];
        } elseif ($pageName === Crud::PAGE_EDIT || $pageName === Crud::PAGE_NEW) {
            return [$nameContact, $emailContact, $messageContact, $phoneContact, $users];
        }
    }
}
