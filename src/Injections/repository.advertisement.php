<?php

return function (\Interop\Container\ContainerInterface $container) {
    return new \TestTask\Repository\Advertisement\AdvertisementRemoteJsonRepository(
        $container->get('factory.advertisement'),
        $container->get('http.advertisement.client')
    );
};