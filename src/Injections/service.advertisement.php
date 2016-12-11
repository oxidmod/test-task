<?php

return function (\Interop\Container\ContainerInterface $container) {
    return new \TestTask\Services\Advertise\AdvertisementService(
        $container->get('service.advertisement.auction'),
        $container->get('repository.advertisement')
    );
};