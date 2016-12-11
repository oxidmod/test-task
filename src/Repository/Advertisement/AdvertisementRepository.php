<?php

namespace TestTask\Repository\Advertisement;

use TestTask\Model\Advertisement\Advertisement;
use TestTask\Repository\RepositoryInterface;
use TestTask\Services\Advertise\Factory\AdvertisementFactory;

/**
 * Class AdvertisementRepository
 */
abstract class AdvertisementRepository implements RepositoryInterface
{
    /**
     * @var AdvertisementFactory
     */
    protected $factory;

    /**
     * AdvertisementRepository constructor.
     * @param AdvertisementFactory $factory
     */
    public function __construct(AdvertisementFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->doFindAll();
    }

    /**
     * @return Advertisement[]
     */
    protected abstract function doFindAll(): array;
}
