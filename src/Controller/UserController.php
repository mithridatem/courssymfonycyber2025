<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserRepository $repo
    ){}

    #[Route('/user', name: 'app_user')]
    public function index(Request $request): Response
    {
        //Instance d'un objet User
        $user = new User();
        //Instance d'un nouveau formulaire UserType
        $form = $this->createForm(UserType::class, $user);
        //Récupération de la requête
        $form->handleRequest($request);

        //condition si le formulaire est submit
        if($form->isSubmitted()) {
            //test si le compte n'existe pas
            if(!$this->repo->findOneBy(['email' => $user->getEmail()])) {
                $user
                    ->setRoles(['ROLE_USER'])
                    ->setAvatar('profil.png');
                $this->em->persist($user);
                $this->em->flush();
                $type = "success";
                $message = "Le compte a été ajouté en BDD";
            }
            else {
                $type = "danger";
                $message = "Le compte existe déja";
            }
            $this->addFlash($type,$message);
        }
        return $this->render('user/user.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}
