<?php

namespace App\Entities;

use App\Embed\Timestamp;
use App\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\SpecializationRepository")
 * @ORM\Table("specialization")
 */
class Specialization
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
         * @ORM\ManyToMany(targetEntity="\App\Entities\Author", inversedBy="specializations", cascade={ "persist" })
         */
        public ?Collection $authors = new ArrayCollection(),

        /**
         * @ORM\Embedded(class="\App\Embed\Timestamp", columnPrefix=false)
         */
        private ?Timestamp $timestamp = new Timestamp()

    ) {}
}