<?php

namespace App\Embed;

use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Timestamp
{
    public function __construct(
        
        /**
         * @ORM\Column(options={ "default": "CURRENT_TIMESTAMP" })
         */
        public readonly ?DateTimeImmutable $createdAt = new DateTimeImmutable(),

        /**
         * @ORM\Column(columnDefinition="DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP")
         */
        public readonly ?DateTime $updatedAt = null,
        
        /**
         * @ORM\Column(nullable=true)
         */
        public readonly ?DateTime $deletedAt = null

    ) {}
}