<?php

namespace TestTask\Repository\President;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use TestTask\Model\President\President;
use TestTask\Services\President\Factory\PresidentFactory;

/**
 * Class PresidentRemoteCsvRepositoryTest
 */
class PresidentRemoteCsvRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PresidentRemoteCsvRepository
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
        $this->repository = new PresidentRemoteCsvRepository(
            new PresidentFactory(),
            $this->client
        );
        parent::setUp();
    }

    /**
     * @param string $data
     * @param President[] $expected
     *
     * @dataProvider providerForSuccessFindAll
     */
    public function testSuccessFindAll(string $data, array $expected)
    {
        $this->client->expects(self::once())
            ->method('request')
            ->willReturnCallback(function () use ($data) {
                return new Response(200, [], $data);
            });

        $result = $this->repository->findAll();
        self::assertCount(count($expected), $result);
        foreach ($expected as $i => $p) {
            self::assertEquals($p, $result[$i]);
        }
    }

    public function providerForSuccessFindAll(): array
    {
        $keys = [
            'name',
            'dateofBirth',
            'dateofDeath',
        ];
        $data1 = [
            'John Doe Jr',
            1980,
            null,
        ];
        $data2 = [
            'John Doe',
            1950,
            2010,
        ];

        return [
            [
                implode(PHP_EOL, [
                    implode(',', $keys),
                    implode(',', $data1),
                ]),
                [
                    new President($data1[0], 1980, (int) date('Y')),
                ]
            ],
            [
                implode(PHP_EOL, [
                    implode(',', $keys),
                    implode(',', $data2),
                ]),
                [
                    new President($data2[0], 1950, 2010),
                ]
            ]
        ];
    }
}
