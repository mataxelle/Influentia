<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUtilTest extends TestCase
{
    // Vérifier que la valeur donnée est True
    public function testTrue(): void
    {
        $user = new User();

        $user->setFirstName('firstname')
             ->setLastName('lastname')
             ->setEmail('true@test.com')
             ->setPassword('password');

        $this->assertTrue($user->getFirstName() === 'firstname');
        $this->assertTrue($user->getLastName() === 'lastname');
        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPassword() === 'password');
    }

    // Vérifier que la valeur donnée est False
    public function testFalse(): void
    {
        $user = new User();

        $user->setFirstName('firstname')
             ->setLastName('lastname')
             ->setEmail('true@test.com')
             ->setPassword('password');

        $this->assertFalse($user->getFirstName() === 'false');
        $this->assertFalse($user->getLastName() === 'false');
        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
    }

    // Vérifier qu'il y a aucune valeur donnée
    public function testEmpty(): void
    {
        $user = new User();

        $this->assertEmpty($user->getFirstName());
        $this->assertEmpty($user->getLastName());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
    }
}
