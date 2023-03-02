<?php

namespace App\Entities;

use App\Embed\Timestamp;
use App\Enums\Gender;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("author")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    public readonly string $id;

    public function __construct(
        
        /**
         * @ORM\Column(length=20)
         */
        public string $firstName,

        /**
         * @ORM\Column(nullable=true, length=20, options={ "default": null })
         */
        public ?string $middleName,

        /**
         * @ORM\Column(length=20)
         */
        public string $lastName,

        /**
         * @ORM\Column(type="string", length=1, enumType="\App\Enums\Gender")
         */
        public Gender $gender,

        /**
         * @ORM\JoinTable(name="authors_specializations",
         *          joinColumns={ @ORM\JoinColumn(name="author_id", referencedColumnName="id") },
         *          inverseJoinColumns={ @ORM\JoinColumn(name="specialization_id", referencedColumnName="id") }
         *      )
         * @ORM\ManyToMany(targetEntity="\App\Entities\Specialization", cascade={ "persist" })
         */
        public ?Collection $specializations = new ArrayCollection(),

        /**
         * @ORM\Column(type="boolean", options={ "default": true })
         */
        public bool $isActive = true,
        /**
         * @ORM\Embedded(class="\App\Embed\Timestamp", columnPrefix=false)
         */
        private ?Timestamp $timestamp = new Timestamp()

    ) { }

    /**
     * @return Author
     */
    public function addSpecialization(Specialization $specialization): Author
    {
        $this->specializations->add($specialization);
        return $this;
    } 
}