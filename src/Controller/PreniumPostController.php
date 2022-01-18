<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreniumPostController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('prenium_post/index.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }

    public function prenium_post_add(): Response
    {
        return $this->render('prenium_post/index.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }

    public function prenium_post_show(): Response
    {
        return $this->render('prenium_post/index.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }

    public function prenium_post_edit(): Response
    {
        return $this->render('prenium_post/index.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }

    public function prenium_post_delete(): Response
    {
        return $this->render('prenium_post/index.html.twig', [
            'controller_name' => 'PreniumPostController',
        ]);
    }
}
