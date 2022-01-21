<?php

namespace App\Controller;


use App\Repository\PostRepository;
use App\Repository\PreniumPostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function admin(PostRepository $postRepository, PreniumPostRepository $preniumPostRepository, UserRepository $userRepository): Response
    {

        $posts = $postRepository->findBy(
            [],
            ['updateDate' => 'DESC']
        );

        $preniumPosts = $preniumPostRepository->findBy(
            [],
            ['updateDate' => 'DESC']
        );

        $users = $userRepository->findBy(
            [],
            ['creationDate' => 'DESC']
        );

        return $this->render('admin/admin.html.twig', [
            'posts' => $posts,
            'preniumPosts' => $preniumPosts,
            'users' => $users
        ]);
    }
}
