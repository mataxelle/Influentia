<?php

namespace App\Service;

use APP\Entity\Order;
use App\Entity\PreniumPost;

class StripeService
{
    private $privateKey;

    public function __construct()
    {
        // clé secret test
        $this->privateKey = new $_ENV['STRIPE_SECRET_KEY'];
    }

    /**
     * @param PreniumPost $preniumPost
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function paymentIntent(PreniumPost $preniumPost) // Associé au formulaire de paiement
    {
        \Stripe\Stripe::setApiKey($this->privateKey);

        return \Stripe\PaymentIntent::create([
            'price' => $preniumPost->getPrice() * 100,
            'currency' => Order::DEVISE,
            'payment_method_types' => ['card']
        ]);
    }

    public function paiement(
        $price,
        $currency,
        $description,
        array $stripeParameter // Tableau parametre lié à Stripe
    )
    {
        \Stripe\Stripe::setApiKey($this->privateKey);
        $payment_intent = null;

        if(isset($stripeParameter['stripeIntentId'])) {
            $payment_intent = \Stripe\PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
        }

        if($stripeParameter['stripeIntentStatus'] === 'succeeded') {
            //TODO
        } else {
            $payment_intent->cancel();
        }

        return $payment_intent;
    }

    /**
     * @param array $stripeParameter
     * @param PreniumPost $preniumPost
     * @return \Stripe\PaymentIntent|null
     */
    public function stripe(array $stripeParameter, PreniumPost $preniumPost)
    {
        return $this->paiement(   // Declenche la methode
            $preniumPost->getPrice() * 100,
            Order::DEVISE,
            $preniumPost->getTitle(),
            $stripeParameter
        );
    }
} 