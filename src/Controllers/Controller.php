<?php

namespace TestTask\Controllers;

use Interop\Container\ContainerInterface;

/**
 * Class Controller
 */
abstract class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
