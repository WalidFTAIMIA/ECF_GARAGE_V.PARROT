<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersCrudController extends AbstractCrudController
{
    
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) 
    {
        
    }

    public static function getEntityFqcn(): string
    {
        return Users::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
       
        return $crud
            ->setEntityLabelInPlural('Employée')
            ->setEntityLabelInSingular('Employée');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Email'),
            TextField::new('Password')
                ->setFormType(PasswordType::class)
                ->onlyOnForms(),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->renderAsBadges([
                    'ROLE_ADMIN' => 'success',
                    'ROLE_EMPLOYER' => 'warning'
                ])
                ->setChoices([
                    'Administrateur' => 'ROLE_ADMIN',
                    'Employées' => 'ROLE_EMPLOYER'
                ])
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
    
    
    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /** @var Users $users */
        $users = $entityInstance;
        $plainPassword = $users->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($users, $plainPassword);

        $users->setPassword($hashedPassword);
        parent::persistEntity($entityManager , $entityInstance);

    }
}
