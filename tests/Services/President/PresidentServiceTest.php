<?php

namespace TestTask\Services\President;

use TestTask\Model\President\President;
use TestTask\Repository\President\PresidentRepository;

/**
 * Class PresidentServiceTest
 */
class PresidentServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PresidentRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    private $presidentRepository;

    /**
     * @var PresidentService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->presidentRepository = $this->createMock(PresidentRepository::class);
        $this->service = new PresidentService($this->presidentRepository);
        parent::setUp();
    }

    public function testCalculateMaxCountOfPresidents()
    {
        $this->presidentRepository->expects(self::once())
            ->method('findAll')
            ->willReturn([
                new President('President #1', 1550, 1610),
                new President('President #2', 1540, 1620),
                new President('President #3', 1560, 1630),
                new President('President #4', 1565, 1600),
                new President('President #5', 1560, 1640),
                new President('President #6', 1600, 1670),
            ]);

        $years = $this->service->calculateMaxCountOfPresidents();
        self::assertCount(1, $years);
        self::assertEquals(6, $years[1600]);
    }
}
