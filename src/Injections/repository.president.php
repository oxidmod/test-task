<?php

return function (\Interop\Container\ContainerInterface $container) {
    return new \TestTask\Repository\President\PresidentRemoteCsvRepository(
        $container->get('factory.president'),
        $container->get('http.president.client')
    );
};