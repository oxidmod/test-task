<?php

namespace TestTask\Model\Advertisement;

/**
 * Class AdvertisementTest
 */
class AdvertisementTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $price = 1;
        $weight = 2;
        $image = 'some image';

        $obj = new Advertisement($price, $weight, $image);
        self::assertEquals($price, $obj->getPrice());
        self::assertEquals($weight, $obj->getWeight());
        self::assertEquals($image, $obj->getImage());
    }
}
