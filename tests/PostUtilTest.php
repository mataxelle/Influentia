<?php

namespace App\Tests;

use App\Entity\Post;
use PHPUnit\Framework\TestCase;

class PostUtilTest extends TestCase
{
    public function testTrue(): void
    {
        $post = new Post();

        $post->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setImage('image');

        $this->assertTrue($post->getTitle() === 'title');
        $this->assertTrue($post->getContent() === 'content');
        $this->assertTrue($post->getAuthor() === 'author');
        $this->assertTrue($post->getImage() === 'image');
    }

    public function testFalse(): void
    {
        $post = new Post();

        $post->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setImage('image');

        $this->assertFalse($post->getTitle() === 'false');
        $this->assertFalse($post->getContent() === 'false');
        $this->assertFalse($post->getAuthor() === 'false');
        $this->assertFalse($post->getImage() === 'false');
    }

    public function testEmpty(): void
    {
        $post = new Post();

        $this->assertEmpty($post->getTitle());
        $this->assertEmpty($post->getContent());
        $this->assertEmpty($post->getAuthor());
        $this->assertEmpty($post->getImage());
    }
}
