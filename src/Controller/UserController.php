<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditAccountType;
use App\Repository\PostRepository;
use App\Repository\PreniumPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function account(User $user): Response
    {
        return $this->render('user/user_account.html.twig', [
            'user' => $user,
        ]);
    }

    public function edit(User $user, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(EditAccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();
            // do anything else you need here, like send an email

            $this->addFlash('message', 'Votre compte à été modifié avec succès');

            return $this->redirectToRoute('user_account', ['id' => $user->getId()]);
        }

        return $this->render('user/user_account_edit.html.twig', [
            'editAccountForm' => $form->createView(),
            'user' => $user
        ]);
    }

    public function delete(User $user, EntityManagerInterface $em): Response
    {
        if ($user) {

            $em->remove($user);
            $em->flush();

            $this->addFlash('message', 'Votre compte à été supprimer avec succès');

            return $this->redirectToRoute('index');
        }

        return $this->render('user/account_delete.html.twig', [
            'user' => $user,
        ]);
    }
}
