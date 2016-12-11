<?php

namespace TestTask\Services\Advertise\Factory;

use TestTask\Model\Advertisement\Advertisement;

class AdvertisementFactory
{
    /**
     * @param int $price
     * @param int $weight
     * @param string $image
     * @return Advertisement
     */
    public function createAdvertisement(int $price, int $weight, string $image): Advertisement
    {
        return new Advertisement($price, $weight, $image);
    }
}
