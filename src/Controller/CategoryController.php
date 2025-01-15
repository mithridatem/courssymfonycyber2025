<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CategoryType;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $repo,
        private readonly EntityManagerInterface $em
    ) {}

    #[Route('/category', name: 'app_category_showAll')]
    public function showAll(): Response
    {

        return $this->render('category/categories.html.twig', [
            'categories' => $this->repo->findAll()
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {

        return $this->render('category/category.html.twig', [
            'category' => $this->repo->find($id)
        ]);
    }

    #[Route('/category/add', name: 'app_category_add')]
    public function addCategory(Request $request): Response
    {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        //Test si le formulaire est submit
        if ($form->isSubmitted()) {
            //test si la catégorie existe
            if (!$this->repo->findOneBy(['libele' => $category->getLibele()])) {
                $this->em->persist($category);
                $this->em->flush();
                $message = "La catégorie à été ajouté en BDD";
                $status = "success";
            } else {
                $message = "La catégorie existe déja";
                $status = "danger";
            }
            $this->addFlash($status, $message);
        }
        return $this->render(
            'category/categoryAdd.html.twig',
            [
                'formulaire' => $form->createView()
            ]
        );
    }
}
