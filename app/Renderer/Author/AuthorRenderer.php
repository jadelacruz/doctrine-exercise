<?php

namespace App\Renderer\Author;

use App\Entities\Author;
use App\Renderer\Renderer;
use App\Renderer\Specialization\SpecializationRenderer;

class AuthorRenderer extends Renderer
{
    /**
     * @param SpecializationRenderer $specializationRenderer
     */
    public function __construct(
        private ?SpecializationRenderer $specializationRenderer = new SpecializationRenderer()
    ) { }

    /**
     * @param Author $author
     * 
     * @return array<string, mixed>
     */
    public function render(Author $author): array
    {
        return [
            'id'              => $author->id,
            'firstName'       => $author->firstName,
            'middleName'      => $author->middleName,
            'lastName'        => $author->lastName,
            'gender'          => $author->gender->toString(),
            'specializations' => $this->specializationRenderer->renderList($author->specializations),
            'createdAt'       => $author->getCreatedAt(),
            'updatedAt'       => $author->getUpdatedAt()
        ];
    }

}