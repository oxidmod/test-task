<?php

return function (\Interop\Container\ContainerInterface $container) {
    return new \GuzzleHttp\Client([
        'base_uri' => 'http://2eu.kiev.ua',
    ]);
};