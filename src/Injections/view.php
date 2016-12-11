<?php

use Interop\Container\ContainerInterface;

return function (ContainerInterface $container) {
    $root = $container->get('__PROJECT_ROOT__');
    $view = new \Slim\Views\Twig("{$root}/src/Views/", [
        'cache' => "{$root}/var/cache/views/",
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};