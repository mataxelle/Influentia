<?php

namespace App\Controller;

use App\Entity\PreniumPost;
use App\Form\PreniumPostType;
use App\Repository\PreniumPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PreniumPostController extends AbstractController
{
    /*private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }*/

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

    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $preniumPost = new PreniumPost();
        $form = $this->createForm(PreniumPostType::class, $preniumPost);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $preniumPost->setUpdateDate(new \DateTime());

            if ($preniumPost->getImage() !== null) {
                $file = $form->get('image')->getData();
                $fileName =  uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $preniumPost->setImage($fileName);
            }

            if (!$preniumPost->getPublicationDate()) {
                $preniumPost->setPublicationDate(new \DateTime());
            }

            $em->persist($preniumPost);
            $em->flush();

            $this->addFlash('message', 'Nouveau post prenium ajouté avec succès');

            return $this->redirectToRoute('prenium_show', ['id' => $preniumPost->getId()]);
        }

        return $this->render('prenium_post/prenium_add.html.twig', [
            'form' => $form->createView(),
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

    public function delete(PreniumPost $preniumPost, EntityManagerInterface $em): Response
    {
        $em->remove($preniumPost);
        $em->flush();

        return $this->redirectToRoute('index');
    }
}
