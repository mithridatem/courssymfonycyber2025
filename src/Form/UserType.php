<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label'=> 'Saisir votre prénom',
                'attr' => ['class'=>"py-3 px-4 block w-full border-gray-200 rounded-lg text-sm 
                focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 
                disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 
                dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"],
                'label_attr'=> [
                    'class' => 'block text-sm mb-2 dark:text-white']
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Saisir votre nom',
                'attr' => ['class'=>"py-3 px-4 block w-full border-gray-200 rounded-lg text-sm 
                focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 
                disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 
                dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"],
                'label_attr'=> [
                    'class' => 'block text-sm mb-2 dark:text-white']
            ])
            ->add('email', EmailType::class,[
                'label'=> 'Saisir votre email',
                'attr' => ['class'=>"py-3 px-4 block w-full border-gray-200 rounded-lg text-sm 
                focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 
                disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 
                dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"],
                'label_attr'=> [
                    'class' => 'block text-sm mb-2 dark:text-white']
            ])
            ->add('password', PasswordType::class,[
                'label'=> 'Saisir votre mot de passe',
                'attr' =>['class'=>"py-3 px-4 block w-full border-gray-200 rounded-lg text-sm 
                focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 
                disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 
                dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"],
                'hash_property_path' => 'password',
                'mapped' => false,
                'label_attr'=> [
                    'class' => 'block text-sm mb-2 dark:text-white']
            ])
            ->add('enregistrer', SubmitType::class,[
                'attr' => ['class' => "w-full py-3 px-4 inline-flex justify-center items-center 
                gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 
                text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 
                disabled:pointer-events-none"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
