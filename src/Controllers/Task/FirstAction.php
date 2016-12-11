<?php

namespace TestTask\Controllers\Task;

use Slim\Http\Request;
use Slim\Http\Response;
use TestTask\Controllers\Action;
use TestTask\Services\Advertise\AdvertisementService;

/**
 * Class FirstAction
 */
class FirstAction extends Action
{
    public function __invoke(Request $request, Response $response)
    {
        /** @var AdvertisementService $service */
        $service = $this->container->get('service.advertisement');
        return $this->container->get('view')
            ->render(
                $response,
                'Task/task1.html.twig',
                [
                    'advertisements' => $service->getAdvertisements($request->getParam('count', 3)),
                ]
            );
    }

}