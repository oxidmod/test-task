<?php

namespace TestTask\Controllers\Home;

use \TestTask\Controllers\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function index(Request $request, Response $response)
    {
        return $this->container
            ->get('view')
            ->render(
                $response,
                'Home/index.html.twig',
                [
                    'links' => [
                        [
                            'url' => 'test_task_1',
                            'title' => 'Test Task 1',
                        ],
                        [
                            'url' => 'test_task_2',
                            'title' => 'Test Task 2',
                        ]
                    ],
                ]
            );
    }
}
