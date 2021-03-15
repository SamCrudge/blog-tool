<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class ReadEntriesController extends Controller
{
    private $blogModel;
    private $renderer;

    /**
     * ReadEntriesController constructor.
     * @param $blogModel
     * @param $renderer
     */
    public function __construct($blogModel, PhpRenderer $renderer)
    {
        $this->blogModel = $blogModel;
        $this->renderer = $renderer;
    }


    public function __invoke(Request $request, Response $response, array $args)
    {
        $responseData =
            [
                'message' => ''
            ];

        $readAllPosts = $this->blogModel->ReadAllEntries();

        if($readAllPosts){

            return $this->respondWithJson($response, $readAllPosts, 200);

        }

        $responseData['message'] = 'There was a problem with your request.';
        return $this->respondWithJson($response, $responseData, 500);

    }

}