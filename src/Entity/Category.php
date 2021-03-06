<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Post", mappedBy="categories")
     */
    private $posts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PreniumPost", mappedBy="categories")
     */
    private $preniumPosts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->preniumPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->addCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            $post->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|PreniumPost[]
     */
    public function getPreniumPosts(): Collection
    {
        return $this->preniumPosts;
    }

    public function addPreniumPost(PreniumPost $preniumPost): self
    {
        if (!$this->preniumPosts->contains($preniumPost)) {
            $this->preniumPosts[] = $preniumPost;
            $preniumPost->addCategory($this);
        }

        return $this;
    }

    public function removePreniumPost(PreniumPost $preniumPost): self
    {
        if ($this->preniumPosts->removeElement($preniumPost)) {
            $preniumPost->removeCategory($this);
        }

        return $this;
    }
}
