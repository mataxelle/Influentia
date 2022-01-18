<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findBy(
            [],
            ['updateDate' => 'DESC']
        );

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function add(): Response
    {
        return $this->render('post/post_add.html.twig');
    }

    public function show(Post $post): Response
    {
        return $this->render('post/post_show.html.twig', [
            'post' => $post,
        ]);
    }

    public function edit(): Response
    {
        return $this->render('post/post_edit.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    public function delete(Post $post): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('index');
    }

    public function about(): Response
    { 
        return $this->render('post/about.html.twig');
    }
}
