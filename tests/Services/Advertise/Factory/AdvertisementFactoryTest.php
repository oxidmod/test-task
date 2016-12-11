<?php

namespace TestTask\Services\Advertise\Factory;

use TestTask\Model\Advertisement\Advertisement;

/**
 * Class AdvertisementFactoryTest
 */
class AdvertisementFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AdvertisementFactory
     */
    private $factory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->factory = new AdvertisementFactory();
        parent::setUp();
    }

    /**
     * Should create advertisement
     */
    public function testCreateAdvertisement()
    {
        $expected = new Advertisement(1, 2, 'http://lorempixel.com/400/200/');
        $result = $this->factory->createAdvertisement(
            $expected->getPrice(),
            $expected->getWeight(),
            $expected->getImage()
        );

        self::assertEquals($expected, $result);
    }
}
