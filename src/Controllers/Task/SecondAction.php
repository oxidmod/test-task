<?php

namespace TestTask\Controllers\Task;

use Slim\Http\Request;
use Slim\Http\Response;
use TestTask\Controllers\Action;
use TestTask\Services\President\PresidentService;

class SecondAction extends Action
{
    public function __invoke(Request $request, Response $response)
    {
        /** @var PresidentService $service */
        $service = $this->container->get('service.president');

        return $this->container->get('view')
            ->render(
                $response,
                'Task/task2.html.twig',
                [
                    'years' => $service->calculateMaxCountOfPresidents(),
                ]
            );
    }

}