<?php

namespace TestTask\Repository\President;
use TestTask\Model\President\President;
use TestTask\Repository\RepositoryInterface;
use TestTask\Services\President\Factory\PresidentFactory;

/**
 * Class PresidentRepository
 */
abstract class PresidentRepository implements RepositoryInterface
{
    /**
     * @var PresidentFactory
     */
    protected $factory;

    /**
     * PresidentRepository constructor.
     * @param PresidentFactory $factory
     */
    public function __construct(PresidentFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return President[]
     */
    public function findAll(): array
    {
        return $this->doFindAll();
    }

    /**
     * @return President[]
     */
    protected abstract function doFindAll(): array;
}
