<?php

namespace TestTask\Controllers;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Action
 */
abstract class Action
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Controller constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    abstract public function __invoke(Request $request, Response $response);
}
