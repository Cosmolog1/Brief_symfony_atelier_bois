<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ProfileTypeForm;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/edit', name: 'profile_edit')]
    public function profile_edit(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        Request $request,
    ): Response {
        // Si je ne suis pas connecté j'ai RIEN A FAIRE ICI

        $user = $this->getUser();

        $form = $this->createForm(ProfileTypeForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');
            // do anything else you need here, like send an email

            // return $security->login($user, AppCustomAuthenticator::class, 'main');
        }
        return $this->render('profile/profile_edit.html.twig', [
            'form' => $form,
        ]);
    }
}
