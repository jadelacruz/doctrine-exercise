<?php

namespace App\Entities;

use App\Embed\Timestamp;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("keyword")
 */
class Keyword
{
    /**
     * @ORM\Id
     * @ORM\Column
     * @ORM\GeneratedValue
     */
    public readonly int $id;
    
    public function __construct(

        /**
         * @ORM\Column(length=25)
         */
        public string $name,

        /**
         * @ORM\ManyToMany(targetEntity="\App\Entities\Article", inversedBy="keywords", cascade={ "persist" })
         * @ORM\JoinTable(name="article_keyword")
         */
        public ?Collection $articles = null,

        /**
         * @ORM\Embedded(class="\App\Embed\Timestamp", columnPrefix=false)
         */
        public ?Timestamp $timestamp = null,

    ) {
        $this->timestamp = new Timestamp();
    }
}