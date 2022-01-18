<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    /*private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }*/

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

    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $post->setUpdateDate(new \DateTime());  //initialisation de la dernière modification

            if ($post->getImage() !== null) {
                $file = $form->get('image')->getData();
                $fileName =  uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans le quel le fichier va être charger (services.yaml)
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $post->setImage($fileName);
            }

            if (!$post->getPublicationDate()) {
                $post->setPublicationDate(new \DateTime());
            }

            $em->persist($post); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete


            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('post/post_add.html.twig', [
            'form' => $form->createView(),
        ]);
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

    public function delete(Post $post, EntityManagerInterface $em): Response
    {
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('index');
    }

    public function about(): Response
    { 
        return $this->render('post/about.html.twig');
    }
}
