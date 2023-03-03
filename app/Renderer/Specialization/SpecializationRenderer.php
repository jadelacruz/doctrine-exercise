<?php

namespace App\Renderer\Specialization;

use App\Entities\Specialization;
use App\Renderer\Renderer;

class SpecializationRenderer extends Renderer
{
    /**
     * @param Specialization $specialization
     * 
     * @return array<string, mixed>
     */
    public function render(Specialization $specialization): array
    {
        return [
            'id'   => $specialization->id,
            'name' => $specialization->name
        ];
    }
}