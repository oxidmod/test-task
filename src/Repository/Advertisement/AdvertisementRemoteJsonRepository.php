<?php

namespace TestTask\Repository\Advertisement;

use GuzzleHttp\Client;
use TestTask\Services\Advertise\Factory\AdvertisementFactory;

/**
 * Class AdvertisementRemoteJsonRepository
 */
class AdvertisementRemoteJsonRepository extends AdvertisementRepository
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * AdvertisementRemoteJsonRepository constructor.
     * @param AdvertisementFactory $factory
     * @param Client $httpClient
     */
    public function __construct(
        AdvertisementFactory $factory,
        Client $httpClient
    ) {
        parent::__construct($factory);
        $this->httpClient = $httpClient;
    }

    /**
     * @return array
     */
    protected function doFindAll(): array
    {
        $response = $this->httpClient->request('GET', '/get_ads.php');
        if ($response->getStatusCode() !== 200) {
            return [];
        }

        return array_map(
            function (array $advData) {
                return $this->factory->createAdvertisement(
                    $advData['price'] ?? 0,
                    $advData['weight'] ?? 0,
                    $advData['image'] ?? 'http://lorempixel.com/400/200/'
                );
            },
            $this->parseJson((string) $response->getBody())
        );
    }

    /**
     * @param string $body
     * @return array
     */
    private function parseJson(string $body): array
    {
        $data = json_decode($body, true);
        if (null === $data) {
            return [];
        }

        if (!is_array($data)) {
            return [];
        }
        return $data;
    }
}
