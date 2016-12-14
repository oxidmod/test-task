<?php

namespace TestTask\Repository\President;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use TestTask\Model\President\President;
use TestTask\Services\President\Factory\PresidentFactory;

/**
 * Class PresidentRemoteCsvRepository
 */
class PresidentRemoteCsvRepository extends PresidentRepository
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * PresidentRemoteCsvRepository constructor.
     * @param PresidentFactory $factory
     * @param Client $httpClient
     */
    public function __construct(PresidentFactory $factory, Client $httpClient)
    {
        parent::__construct($factory);
        $this->httpClient = $httpClient;
    }

    /**
     * @return President[]
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    protected function doFindAll(): array
    {
        $response = $this->httpClient->request('GET', '/presidents.csv');
        if ($response->getStatusCode() !== 200) {
            return [];
        }

        return array_map(
            function (array $data) {
                return $this->factory->createPresident(
                    $data['name'] ?? 'John Doe',
                    (int) ($data['dateofBirth'] ?: 0),
                    (int) ($data['dateofDeath'] ?: date('Y'))
                );
            },
            $this->parseCsv($response->getBody())
        );
    }

    /**
     * @param Stream $body
     * @return array
     */
    private function parseCsv(Stream $body): array
    {
        if (!$body->isReadable()) {
            return [];
        }

        if (!$body->getSize()) {
            return [];
        }

        $content = (string) $body;
        $lines = explode(PHP_EOL, $content);
        if (count($lines) < 2) {
            return [];
        }
        $keys = str_getcsv(array_shift($lines));

        return array_filter(array_map(function (string $line) use ($keys) {
            return array_combine($keys, str_getcsv($line));
        }, $lines));
    }
}
