<?php

require_once __DIR__.'/../vendor/autoload.php';

$container = new \TestTask\Services\Container\Container([
    'injectionsPath' => __DIR__.'/../src/Injections',
]);

$app = new Slim\App($container);

$app->get('/', '\TestTask\Controllers\Home\HomeController:index')->setName('home');
$app->get('/task-1', '\TestTask\Controllers\Task\FirstAction')->setName('test_task_1');
$app->get('/task-2', '\TestTask\Controllers\Task\SecondAction')->setName('test_task_2');

$app->run();
