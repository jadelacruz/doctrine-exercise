<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use App\Entities\Specialization;

class SpecializationRepository extends EntityRepository
{
    /**
     * @var string
     * @return Specialization
     */
    public function findOrCreate(string $name): Specialization
    {
        $specialization = $this->findOneBy(['name' => $name]);
        
        if ($specialization === null) {
            $specialization = new Specialization(name: $name);
        }

        return $specialization;
    }
}