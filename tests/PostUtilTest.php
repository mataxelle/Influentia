<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class PostUtilTest extends TestCase
{
    public function testTrue(): void
    {
        $post = new Post();
        $user = new User();
        $datetime = new DateTime();
        $categories = new Category;

        $post->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setUser($user)
             ->setImage('image')
             ->setPublicationDate($datetime)
             ->setUpdateDate($datetime)
             ->addCategory($categories);

        $this->assertTrue($post->getTitle() === 'title');
        $this->assertTrue($post->getContent() === 'content');
        $this->assertTrue($post->getAuthor() === 'author');
        $this->assertTrue($post->getUser() === $user);
        $this->assertTrue($post->getImage() === 'image');
        $this->assertTrue($post->getPublicationDate() === $datetime);
        $this->assertTrue($post->getUpdateDate() === $datetime);
        $this->assertContains($categories, $post->getCategories());
    }

    public function testFalse(): void
    {
        $post = new Post();
        $user = new User();
        $datetime = new DateTime();
        $categories = new Category;

        $post->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setUser($user)
             ->setImage('image')
             ->setPublicationDate($datetime)
             ->setUpdateDate($datetime)
             ->addCategory($categories);

        $this->assertFalse($post->getTitle() === 'false');
        $this->assertFalse($post->getContent() === 'false');
        $this->assertFalse($post->getAuthor() === 'false');
        $this->assertFalse($post->getUser() === new User());
        $this->assertFalse($post->getImage() === 'false');
        $this->assertFalse($post->getPublicationDate() === new Datetime);
        $this->assertFalse($post->getUpdateDate() === new Datetime);
        $this->assertNotContains(new Category(), $post->getCategories());
    }

    public function testEmpty(): void
    {
        $post = new Post();

        $this->assertEmpty($post->getTitle());
        $this->assertEmpty($post->getContent());
        $this->assertEmpty($post->getAuthor());
        $this->assertEmpty($post->getUser());
        $this->assertEmpty($post->getImage());
        $this->assertEmpty($post->getPublicationDate());
        $this->assertEmpty($post->getUpdateDate());
        $this->assertEmpty($post->getCategories());
    }
}
