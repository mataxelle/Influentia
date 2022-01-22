<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{
    public function cart(): Response
    {
        return $this->render('cart_checkout/cart.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
    }
    
    public function checkout(): Response
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        $session = Session::create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
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
