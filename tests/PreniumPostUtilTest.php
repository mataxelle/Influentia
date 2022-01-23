<?php

namespace App\Tests;

use App\Entity\PreniumPost;
use PHPUnit\Framework\TestCase;

class PreniumPostUtilTest extends TestCase
{
    public function testTrue(): void
    {
        $preniumPost = new PreniumPost();

        $preniumPost->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setImage('image');

        $this->assertTrue($preniumPost->getTitle() === 'title');
        $this->assertTrue($preniumPost->getContent() === 'content');
        $this->assertTrue($preniumPost->getAuthor() === 'author');
        $this->assertTrue($preniumPost->getImage() === 'image');
    }

    public function testFalse(): void
    {
        $preniumPost = new PreniumPost();

        $preniumPost->setTitle('title')
             ->setContent('content')
             ->setAuthor('author')
             ->setImage('image');

        $this->assertFalse($preniumPost->getTitle() === 'false');
        $this->assertFalse($preniumPost->getContent() === 'false');
        $this->assertFalse($preniumPost->getAuthor() === 'false');
        $this->assertFalse($preniumPost->getImage() === 'false');
    }

    public function testEmpty(): void
    {
        $preniumPost = new PreniumPost();

        $this->assertEmpty($preniumPost->getTitle());
        $this->assertEmpty($preniumPost->getContent());
        $this->assertEmpty($preniumPost->getAuthor());
        $this->assertEmpty($preniumPost->getImage());
    }
}
