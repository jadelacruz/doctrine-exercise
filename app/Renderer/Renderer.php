<?php

namespace App\Renderer;

abstract class Renderer
{
    public function renderList($classes): array
    {
        $buffer = [];

        /** @var Class @class */
        foreach ($classes as $class) {
            $buffer[] = $this->render($class);
        }

        return $buffer;
    }
}