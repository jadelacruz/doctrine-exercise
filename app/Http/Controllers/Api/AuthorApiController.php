<?php

namespace App\Http\Controllers\Api;

use App\Enums\Gender;
use App\Entities\Author;
use App\Http\Controllers\Controller;
use App\Renderer\Author\AuthorRenderer;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class AuthorApiController extends Controller
{
    /**
     * @param AuthorService $authorService
     * @param AuthorRenderer $authorRenderer
     */
    public function __construct(
        /**
         * @var AuthorService $authorService
         */
        private AuthorService $authorService,

        /**
         * @var AuthorRenderer $authorRenderer
         */
        private AuthorRenderer $authorRenderer

    ) { }

    /**
     * @param string $guid
     */
    public function getAuthorById(string $guid): JsonResponse
    {
        $author = $this->authorService->getAuthorById($guid);
        return Response::json($this->authorRenderer->render($author));       
    }
    
    /**
     * @return JsonResponse
     */
    public function createAuthor(): JsonResponse
    {
        // No encryption of personal information for simplicity
        $result = $this->authorService->createAuthor(
            new Author(
                firstName : Request::get('first_name'),
                middleName: Request::get('middle_name'),
                lastName  : Request::get('last_name'),
                gender    : Gender::from(Request::get('gender'))
            ),
            Request::get('specializations')
        );
        
       if ($result === false) {
            throw new \Exception('Creating author gone wrong.');        
       }

       return Response::json(['message' => 'Author has been created successfully']);
    }
}