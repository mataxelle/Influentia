<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\PreniumPost;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class PreniumPostUtilTest extends TestCase
{
    public function testTrue(): void
    {
        $preniumPost = new PreniumPost();
        $user = new User();
        $datetime = new DateTime();
        $categories = new Category;

        $preniumPost->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setUser($user)
             ->setImage('image')
             ->setPublicationDate($datetime)
             ->setUpdateDate($datetime)
             ->addCategory($categories);

        $this->assertTrue($preniumPost->getTitle() === 'title');
        $this->assertTrue($preniumPost->getContent() === 'content');
        $this->assertTrue($preniumPost->getAuthor() === 'author');
        $this->assertTrue($preniumPost->getUser() === $user);
        $this->assertTrue($preniumPost->getImage() === 'image');
        $this->assertTrue($preniumPost->getPublicationDate() === $datetime);
        $this->assertTrue($preniumPost->getUpdateDate() === $datetime);
        $this->assertContains($categories, $preniumPost->getCategories());
    }

    public function testFalse(): void
    {
        $preniumPost = new PreniumPost();
        $user = new User();
        $datetime = new DateTime();
        $categories = new Category;

        $preniumPost->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setUser($user)
             ->setImage('image')
             ->setPublicationDate($datetime)
             ->setUpdateDate($datetime)
             ->addCategory($categories);

        $this->assertFalse($preniumPost->getTitle() === 'false');
        $this->assertFalse($preniumPost->getContent() === 'false');
        $this->assertFalse($preniumPost->getAuthor() === 'false');
        $this->assertFalse($preniumPost->getUser() === new User());
        $this->assertFalse($preniumPost->getImage() === 'false');
        $this->assertFalse($preniumPost->getPublicationDate() === new Datetime);
        $this->assertFalse($preniumPost->getUpdateDate() === new Datetime);
        $this->assertNotContains(new Category(), $preniumPost->getCategories());
    }

    public function testEmpty(): void
    {
        $preniumPost = new PreniumPost();

        $this->assertEmpty($preniumPost->getTitle());
        $this->assertEmpty($preniumPost->getContent());
        $this->assertEmpty($preniumPost->getAuthor());
        $this->assertEmpty($preniumPost->getUser());
        $this->assertEmpty($preniumPost->getImage());
        $this->assertEmpty($preniumPost->getPublicationDate());
        $this->assertEmpty($preniumPost->getUpdateDate());
        $this->assertEmpty($preniumPost->getCategories());
    }
}
