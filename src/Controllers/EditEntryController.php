<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Validators\Validators;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;

class EditEntryController extends Controller
{
    private $blogModel;

    /**
     * editEntryController constructor.
     * @param $blogModel
     */
    public function __construct($blogModel)
    {
        $this->blogModel = $blogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $responseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $blogDataPost = $request->getParsedBody();
        $blogPost = new Validator($blogDataPost);
        if (!Validators::ValidateEdit($blogPost)) {
            $responseData['success'];
            $responseData['message'] = 'Your post does not meet requirements';
            $responseData['data'] = $blogPost->errors();

            return $this->respondWithJson($response, $responseData, 500);
        }
        $result = $this->blogModel->EditEntry($blogPost);
        var_dump($result);
        if ($result) {

            $responseData['success'] = true;
            $responseData['message'] = "Your post has been successfully saved!";
            $responseData['data'] = $result;
            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['success'];
        $responseData['message'] = "something went wrong";
        $responseData['data'] = $blogPost;

        return $this->respondWithJson($response, $responseData, 500);
    }
}
