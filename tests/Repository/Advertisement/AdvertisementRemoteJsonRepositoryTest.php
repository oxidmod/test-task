<?php

namespace TestTask\Repository\Advertisement;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use TestTask\Model\Advertisement\Advertisement;
use TestTask\Services\Advertise\Factory\AdvertisementFactory;

/**
 * Class AdvertisementRemoteJsonRepositoryTest
 */
class AdvertisementRemoteJsonRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AdvertisementRemoteJsonRepository
     */
    private $repository;

    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->client = $this->createMock(Client::class);
        $this->repository = new AdvertisementRemoteJsonRepository(
            new AdvertisementFactory(),
            $this->client
        );
        parent::setUp();
    }

    public function testSuccessFindAll()
    {
        $image = 'some image path';
        $price = 1;
        $weight = 10;
        $this->client->expects(self::once())
            ->method('request')
            ->willReturnCallback(function () use ($price, $weight, $image) {
                $response = new Response(200, [], json_encode([
                    [
                        'price' => $price,
                        'weight' => $weight,
                        'image' => $image,
                    ],
                ]));
                return $response;
            });

        $result = $this->repository->findAll();
        self::assertCount(1, $result);
        /** @var Advertisement $resultAdvertisement */
        $resultAdvertisement = $result[0];
        self::assertEquals($price, $resultAdvertisement->getPrice());
        self::assertEquals($weight, $resultAdvertisement->getWeight());
        self::assertEquals($image, $resultAdvertisement->getImage());
    }

    public function testNotSuccessfulCode()
    {
        $this->client->expects(self::once())
            ->method('request')
            ->willReturnCallback(function () {
                return new Response(500, [], '');
            });

        $result = $this->repository->findAll();
        self::assertCount(0, $result);
    }

    public function testNotJsonResponse()
    {
        $this->client->expects(self::once())
            ->method('request')
            ->willReturnCallback(function () {
                return new Response(200, [], 'not a valid json');
            });

        $result = $this->repository->findAll();
        self::assertCount(0, $result);
    }
}
