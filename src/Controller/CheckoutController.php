<?php

namespace App\Controller;

use App\Entity\PreniumPost;
use App\Repository\PreniumPostRepository;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{
    public function cart(SessionInterface $session, PreniumPostRepository $preniumPostRepository)
    {
        $panier = $session->get('panier', []);

        $panierObject = [];

        foreach($panier as $id => $quantity) {
            $panierObject[] = [
                'item' => $preniumPostRepository->find($id),
                'quantity' => $quantity = 1
            ];
        }

        $total = 0;

        foreach($panierObject as $item) {
            $totalItem = $item['item']->getPrice() * $quantity;
            $total += $totalItem;
        }

        return $this->render('cart_checkout/cart.html.twig', [
            'preniumPosts' => $panierObject,
            'total' => $total
        ]);
    }
    
    public function add(PreniumPost $preniumPost, SessionInterface $session, Request $request)
    {
        $panier = $session->get('panier', []);

        $id = $preniumPost->getId();

        if (!empty($panier[$id])) {
            $panier[$id];
        } else {
            $panier[$id] = 1;
        }
        

        $session->set('panier', $panier);
        
        return $this->redirectToRoute('cart');
    }

    public function remove(PreniumPost $preniumPost, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        $id = $preniumPost->getId();

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        
        return $this->redirectToRoute('cart');
    }

    public function deleteAll(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->redirectToRoute('cart');
    }
    
    public function checkout(): Response
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Shoes'
                    ],
                    'unit_amount' => 300
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('checkout_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('checkout_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($session->url, 303);
    }

    public function success(): Response
    {
        return $this->render('cart_checkout/checkout_success.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
    }

    public function cancel(): Response
    {
        return $this->render('cart_checkout/checkout_cancel.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
    }
}
