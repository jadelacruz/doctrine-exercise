<?php

namespace App\Services;

use App\Entities\Author;
use App\Entities\Specialization;
use App\Enums\Gender;
use App\Repositories\AuthorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class AuthorService
{
    public function __construct(
       /**
        * @var EntityManagerInterface $entityManager
        */
       private EntityManagerInterface $entityManager,

       /**
        * @var AuthoRepository|null $authorRepository
        */
       private ?AuthorRepository $authorRepository = null

    ) { 
        $this->authorRepository = $entityManager->getRepository(Author::class);
    }

    /**
     * @return array|Authors[]
     */
    public function getAllAuthors(): array
    {
        return $this->authorRepository->findAll();
    }

    /**
     * @param string $guid
     * 
     * @return Author|null
     */
    public function getAuthorById(string $guid): ?Author
    {
        /** @var Author $author */
        $author = $this->authorRepository->find($guid);
        
        return $author;
    }

    /**
     * @param Author   $author
     * @param string[] $specializations
     * 
     * @return bool
     */
    public function createAuthor(Author $author, array $specializations): bool
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

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param string $guid
     * @param array  $updatedInfo
     * 
     * @return bool
     */
    public function updateAuthor(string $guid, array $updateInfo): bool 
    {
        try {
            /** @var Author $author */
            $author = $this->authorRepository->find($guid);
            $this->removeSpecializations($author->specializations);
            $author->firstName  = $updateInfo['firstName'];
            $author->middleName = $updateInfo['middleName'];
            $author->lastName   = $updateInfo['lastName'];
            $author->gender     = Gender::from($updateInfo['gender']);
            $specializations    = $updateInfo['specializations'];

            foreach ($specializations as $specializationName) {
                $author->addSpecialization(new Specialization($specializationName));
            }

            $this->entityManager->persist($author);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function removeSpecializations(?Collection $specializations): bool
    {
        /** @var Specialization $specialization */
        foreach ($specializations as $specialization) {
            $this->entityManager->remove($specialization);
        }
    }
}