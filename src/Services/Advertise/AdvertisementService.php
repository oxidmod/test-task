<?php

namespace TestTask\Services\Advertise;

use oxidmod\MyRTB\RTB;
use TestTask\Model\Advertisement\Advertisement;
use TestTask\Model\Advertisement\SortableAdvertisement;
use TestTask\Repository\Advertisement\AdvertisementRepository;

/**
 * Class AdvertisementService
 */
class AdvertisementService
{
    /**
     * @var RTB
     */
    private $auction;

    /**
     * @var AdvertisementRepository
     */
    private $repository;

    /**
     * AdvertiseService constructor.
     * @param RTB $auction
     * @param AdvertisementRepository $repository
     */
    public function __construct(RTB $auction, AdvertisementRepository $repository)
    {
        $this->auction = $auction;
        $this->repository = $repository;
    }

    /**
     * @param int $count
     * @return Advertisement[]
     */
    public function getAdvertisements(int $count): array
    {
        $list = $this->repository->findAll();
        return $this->unWrapAdvertisements(
            $this->auction->getItems(
                $count,
                $this->wrapAdvertisement($list)
            )
        );
    }

    /**
     * @param Advertisement[] $items
     *
     * @return SortableAdvertisement[]
     */
    private function wrapAdvertisement(array $items): array
    {
        return array_map(function (Advertisement $advertisement) {
            return new SortableAdvertisement($advertisement);
        }, $items);
    }

    /**
     * @param SortableAdvertisement[] $items
     * @return array
     */
    private function unWrapAdvertisements(array $items): array
    {
        return array_map(function (SortableAdvertisement $wrappedAdvertisement) {
            return $wrappedAdvertisement->getAdvertisement();
        }, $items);
    }
}
