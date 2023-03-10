<?php

namespace App\Enums;

enum Gender: string
{
    case MALE   = 'm';
    case FEMALE = 'f';

    /**
     * @return string
     */
    public function toString(): string 
    {
        return ucfirst(strtolower($this->name));
    }
}