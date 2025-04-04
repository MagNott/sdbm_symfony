<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


#[Route('/article')]
class ArticleController extends AbstractController
{

    #[Route('/', name: 'app_article_index', methods: ['GET', 'POST'])]
    public function index(ArticleRepository $articleRepository, EntityManagerInterface $entityManager, Request $request, TranslatorInterface $translator): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();


              // Génération du message d'information
          $this->addFlash(
            'success',
            $translator->trans('L\'Article a bien été ajouté !')
          );

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'form' => $form,
            'article' => $article,
        ]);
    }

    // #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $article = new Article();
    //     $form = $this->createForm(ArticleType::class, $article);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($article);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('article/new.html.twig', [
    //         'article' => $article,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{idArticle}', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{idArticle}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager, TranslatorInterface $translator
    ): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();


            
          // Génération du message d'information
          $this->addFlash(
            'info',
            $translator->trans('L\'Article a bien été modifié !')
          );

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{idArticle}', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getIdArticle(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();

              
          // Génération du message d'information
          $this->addFlash(
            'danger',
            $translator->trans ('L\'Article a bien été supprimé !')
          );
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
