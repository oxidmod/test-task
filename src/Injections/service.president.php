<?php

return function (\Interop\Container\ContainerInterface $container) {
    return new \TestTask\Services\President\PresidentService(
        $container->get('repository.president')
    );
};