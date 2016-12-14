<?php

return function (\Interop\Container\ContainerInterface $container) {
    return $container->get('http.advertisement.client');
};