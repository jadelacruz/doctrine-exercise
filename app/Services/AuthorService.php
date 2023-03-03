<?php

namespace App\Services;

use App\Entities\Author;
use App\Entities\Specialization;
use Doctrine\ORM\EntityManagerInterface;

class AuthorService
{
    public function __construct(
       /**
        * @var EntityManagerInterface $entityManager
        */
       private EntityManagerInterface $entityManager,

       /**
        * @var \Doctrine\ORM\QueryBuilder|null
        */
       private ?\Doctrine\ORM\QueryBUilder $qb = null,
    ) { 
        $this->qb = $this->entityManager->createQueryBuilder();
    }

    /**
     * @param string $guid
     * 
     * @return Author|null
     */
    public function getAuthorById(string $guid): ?Author
    {
        /** @var Author $author */
        $author = $this->entityManager
                       ->find(Author::class, $guid);
        
        return $author;
    }

    /**
     * @param Author   $author
     * @param string[] $specializations
     * 
     * @return bool
     */
    public function createAuthor(Author $author, array $specializations)
    {
        try {
            if (empty($specializations) === false) {
                /** @var \App\Repositories\SpecializationRepository $specializationRepo */
                $specializationRepo = $this->entityManager->getRepository(Specialization::class);
                foreach ($specializations as $name) {
                    $author->addSpecialization($specializationRepo->findOrCreate($name));
                }
            }
            
            $this->entityManager->persist($author);
            $this->entityManager->flush();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}