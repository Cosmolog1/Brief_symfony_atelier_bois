<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryTypeForm;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/add', name: 'category_add')]
    public function category_add(
        EntityManagerInterface $entityManager,
        Request $request,
    ): Response {

        $category = new Category();
        $form = $this->createForm(CategoryTypeForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('category/category_add.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/category/category_show/{id}', name: 'category_show')]
    public function category_show(
        // Category $category,
        int $id,
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
    ): Response {

        $category = $categoryRepository->find($id);
        $articles = $articleRepository->findby(
            ['category' => $id]
        );


        return $this->render('category/category_show.html.twig', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}
