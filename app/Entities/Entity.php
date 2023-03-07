<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * class Entity
 * @package App\Entities
 */
abstract class Entity
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @param string|int|bool|float|mixed $param
     * @throws \InvalidArgumentException
     */
    protected function checkRequiredParam($param, string $paramName): void
    {
        if (empty($param)) {
            throw new \InvalidArgumentException("\"{$paramName}\" required parameter is missing.");
        }
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }
}