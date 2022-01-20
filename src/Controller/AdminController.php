<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Post;
use App\Entity\PreniumPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function admin(EntityManagerInterface $em): Response
    {

        $posts = $this->$em->getRepository(Propertie::class)->findBy(
            [],
            ['updatedAt' => 'DESC']
        );

        $preniumPosts = $this->$em->getRepository(Propertie::class)->findBy(
            [],
            ['updatedAt' => 'DESC']
        );

        $users = $this->$em->getRepository(User::class)->findBy(
            [],
            ['inscription_date' => 'DESC']
        );

        return $this->render('admin/index.html.twig', [
            'properties' => $posts,
            'preniumPosts' => $preniumPosts,
            'users' => $users
        ]);
    }
}
