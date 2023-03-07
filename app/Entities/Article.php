<?php

namespace App\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("article")
 */
class Article extends Entity
{
    public function __construct(

        /**
         * @ORM\Column(length="50")
         */
        private string $title,

        /**
         * @ORM\Column(length=20, unique=true)
         */
        private string $slug,

        /**
         * @ORM\Column(length=20)
         */
        private string $blurb,

        /**
         * @ORM\Column(type="text")
         */
        private string $content,

        /**
         * @ORM\OneToMany(targetEntity="\App\Entities\Keyword", mappedBy="articles", cascade={ "persist" })
         */
        private ?Collection $keywords = new ArrayCollection(),

        /**
         * @ORM\Column(nullable=true, options={ "default": null })
         */
        private ?DateTime $datePublished = null,
    ) { }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->checkRequiredParam($title, 'title');
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->checkRequiredParam($slug, 'slug');
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of blurb
     * @return string
     */ 
    public function getBlurb(): string
    {
        return $this->blurb;
    }

    /**
     * @param string $blurb
     *
     * @return  self
     */ 
    public function setBlurb(string $blurb): self
    {
        $this->checkRequiredParam($blurb, 'blurb');
        $this->blurb = $blurb;

        return $this;
    }

    /**
     * Get the value of content
     * 
     * @return string
     */ 
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return  self
     */ 
    public function setContent(string $content): self
    {
        $this->checkRequiredParam($content, 'content');
        $this->content = $content;

        return $this;
    }

    /**
     * @return ArrayCollection<Keywords> $keywords
     */ 
    public function getKeywords(): ArrayCollection
    {
        return $this->keywords;
    }

    /**
     * Get the value of datePublished
     * @return DateTime|Null
     */ 
    public function getDatePublished(): ?DateTime
    {
        return $this->datePublished;
    }

    /**
     * @param string|null $datePublished
     *
     * @return self
     */ 
    public function setDatePublished(?string $datePublished): self
    {
        $this->datePublished = $datePublished;

        return $this;
    }
}