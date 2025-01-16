<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            EmailField::new('email', 'Email'),
            TextField::new('password')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions(
                    [
                        'type' => PasswordType::class,
                        'first_options' => [
                        'label' => 'Password',
                        'hash_property_path' => 'password',
                        ],
                        'second_options' => ['label' => '(Confirmer)'],
                        'mapped' => false,
                    ]
                )
                ->onlyOnForms(),
                CollectionField::new('roles', 'Roles')
        ];
    }
    
}
