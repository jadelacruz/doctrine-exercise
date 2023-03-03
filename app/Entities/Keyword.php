<?php

namespace App\Entities;

use App\Embed\Timestamp;
use App\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("keyword")
 */
class Keyword
{
    use TimestampTrait;

    /**
     * @ORM\Id
     * @ORM\Column
     * @ORM\GeneratedValue
     */
    public readonly int $id;
    
    public function __construct(

        /**
         * @ORM\Column(length=25, unique=true)
         */
        public string $name,

        /**
         * @ORM\ManyToMany(targetEntity="\App\Entities\Article", inversedBy="keywords", cascade={ "persist" })
         * @ORM\JoinTable(name="article_keyword")
         */
        public ?Collection $articles = new ArrayCollection(),

        /**
         * @ORM\Embedded(class="\App\Embed\Timestamp", columnPrefix=false)
         */
        public ?Timestamp $timestamp = new Timestamp(),

    ) { }
}