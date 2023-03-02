<?php

namespace App\Entities;

use DateTime;
use App\Embed\Timestamp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column
     * @ORM\GeneratedValue
     */
    public readonly int $id;

    public function __construct(

        /**
         * @ORM\Column(length="50")
         */
        public string $title,

        /**
         * @ORM\Column(length=20, unique=true)
         */
        public string $slug,

        /**
         * @ORM\Column(length=20)
         */
        public string $blurb,

        /**
         * @ORM\Column(type="text")
         */
        public string $content,

        /**
         * @ORM\OneToMany(targetEntity="\App\Entities\Keyword", mappedBy="articles", cascade={ "persist" })
         */
        public ?Collection $keywords = new ArrayCollection(),

        /**
         * @ORM\Column(nullable=true, options={ "default": null })
         */
        public ?DateTime $datePublished = null,

        /**
         * @ORM\Embedded(class="\App\Embed\Timestamp", columnPrefix=false)
         */
        public ?Timestamp $timestamp = new Timestamp()

    ) { }
}