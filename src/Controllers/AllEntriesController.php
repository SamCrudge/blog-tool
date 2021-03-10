<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AllEntriesController extends Controller
{
    private $blogModel;
    private $benderer;

    /**
     * AllEntriesController constructor.
     * @param $blogModel
     * @param $renderer
     */
    public function __construct($blogModel, PhpRenderer $renderer)
    {
        $this->BlogModel = $blogModel;
        $this->Renderer = $renderer;
    }


    public function __invoke(Request $request, Response $response, array $args)
    {
        $Data = ['AllBlogs'] = $this->blogModel->GetAllEntries();
        return $this->renderer->render($response, '/', $Data);
    }


}
