<?php

namespace App\Controller;

use App\Entity\PreniumPost;
use App\Repository\PreniumPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreniumPostController extends AbstractController
{
    public function prenium(PreniumPostRepository $preniumPostRepository): Response
    {
        $preniumPosts = $preniumPostRepository->findBy(
            [],
            ['updateDate' => 'DESC']
        );

        return $this->render('prenium_post/index.html.twig', [
            'preniumPosts' => $preniumPosts,
        ]);
    }

    public function add(): Response
    {
        return $this->render('prenium_post/prenium_add.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }

    public function show(PreniumPost $preniumPost): Response
    {
        return $this->render('prenium_post/prenium_show.html.twig', [
            'preniumPost' => $preniumPost,
        ]);
    }

    public function edit(): Response
    {
        return $this->render('prenium_post/prenium_edit.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }

    public function delete(PreniumPost $preniumPost): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($preniumPost);
        $em->flush();

        return $this->redirectToRoute('index');
    }
}
