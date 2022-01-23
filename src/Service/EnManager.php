<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class EnManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}