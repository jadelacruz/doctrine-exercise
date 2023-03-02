<?php

namespace App\Entities;

use App\Embed\Timestamp;
use App\Enums\Gender;
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
         * @ORM\OneToMany(targetEntity="\App\Entities\Specialization", mappedBy="authors", cascade={ "persist" })
         */
        public ?Collection $specializations = null,

        /**
         * @ORM\Column(type="boolean", options={ "default": true })
         */
        public bool $isActive = true,
        /**
         * @ORM\Embedded(class="\App\Embed\Timestamp", columnPrefix=false)
         */
        private ?Timestamp $timestamp = null

    ) {
        $this->timestamp = new Timestamp();
    }
}