<?php

namespace TestTask\Services\Advertise;
use oxidmod\MyRTB\RTB;
use TestTask\Model\Advertisement\Advertisement;
use TestTask\Repository\Advertisement\AdvertisementRepository;

/**
 * Class AdvertisementServiceTest
 */
class AdvertisementServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AdvertisementRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    private $repository;

    /**
     * @var AdvertisementService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->repository = $this->createMock(AdvertisementRepository::class);
        $this->service = new AdvertisementService(
            new RTB(),
            $this->repository
        );
        parent::setUp();
    }

    public function testSuccessGet()
    {
        $advertisement1 = new Advertisement(1, 2, 'qweqwe');
        $advertisement2 = new Advertisement(2, 2, 'qweqwe');

        $this->repository->expects(self::once())
            ->method('findAll')
            ->willReturn([
                $advertisement1,
                $advertisement2,
            ]);

        $result = $this->service->getAdvertisements(1);
        self::assertCount(1, $result);
        self::assertSame($advertisement2, $result[0]);
    }
}
