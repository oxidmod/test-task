<?php

namespace TestTask\Model\Advertisement;

/**
 * Class SortableAdvertisementTest
 */
class SortableAdvertisementTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAdvertisement()
    {
        $advertisement = new Advertisement(1, 2, 'some image');
        $sortable = new SortableAdvertisement($advertisement);
        self::assertSame($advertisement, $sortable->getAdvertisement());
    }

    /**
     * @dataProvider providerForCompareTo
     * @param SortableAdvertisement $obj1
     * @param SortableAdvertisement $obj2
     * @param int $expected
     */
    public function testCompareTo(SortableAdvertisement $obj1, SortableAdvertisement $obj2, int $expected)
    {
        $result = $obj1->compareTo($obj2);
        self::assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function providerForCompareTo(): array
    {
        $advertisement1 = new Advertisement(1, 1, 'bla-bla');
        $advertisement2 = new Advertisement(2, 1, 'bla-bla');
        $advertisement3 = new Advertisement(1, 2, 'bla-bla');
        $advertisement4 = new Advertisement(1, 2, 'bla-bla');

        return [
            [new SortableAdvertisement($advertisement1), new SortableAdvertisement($advertisement2), 1],
            [new SortableAdvertisement($advertisement2), new SortableAdvertisement($advertisement1), -1],
            [new SortableAdvertisement($advertisement1), new SortableAdvertisement($advertisement1), 0],
            [new SortableAdvertisement($advertisement1), new SortableAdvertisement($advertisement3), 1],
            [new SortableAdvertisement($advertisement3), new SortableAdvertisement($advertisement1), -1],
            [new SortableAdvertisement($advertisement3), new SortableAdvertisement($advertisement4), 0],
        ];
    }
}
