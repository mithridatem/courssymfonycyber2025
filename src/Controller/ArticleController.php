<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Article;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $repo,
        private readonly UserRepository $userRepo,
        private readonly EntityManagerInterface $em
    ) {}

    //Méthode pour afficher tous les articles
    #[Route('/', name: 'app_article_all')]
    public function showAll(): Response
    {
        return $this->render('article/articles.html.twig', [
            'articles' => $this->repo->findAll()
        ]);
    }
    
    //Méthode qui ajoute un article en BDD
    #[Route('/articles/add', name: 'app_articles_add')]
    public function addArticle(Request $request): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //Test si l'article existe déja
            if (!$this->repo->findOneBy([
                'title' => $article->getTitle(),
                'content' => $article->getContent()
            ])) {
                $user = $this->userRepo->find(1);
                $article->setUsers($user);
                $this->em->persist($article);
                $this->em->flush();
                $type = "success";
                $msg = "Article ajouté en BDD";
            }
            //Sinon on affiche une erreur
            else {
                $type = "danger";
                $msg = "Article existe déja en BDD";
            }
            $this->addFlash($type,$msg);
        }


        return $this->render(
            'article/articleadd.html.twig',
            [
                'form' => $form
            ]
        );
    }

    //Méthode pour afficher un article par son id
    #[Route('/article/{id}', name: 'app_article_id', requirements: ['id' => '\d+'])]
    public function showArticleById(int $id): Response
    {
        return $this->render('article/article.html.twig', [
            'article' => $this->repo->find($id)
        ]);
    }
}
