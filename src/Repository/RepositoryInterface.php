<?php

namespace TestTask\Repository;

/**
 * Interface RepositoryInterface
 */
interface RepositoryInterface
{
    /**
     * @return array
     */
    public function findAll(): array;
}
