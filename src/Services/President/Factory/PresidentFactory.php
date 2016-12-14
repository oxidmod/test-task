<?php

namespace TestTask\Services\President\Factory;

use TestTask\Model\President\President;

/**
 * Class PresidentFactory
 */
class PresidentFactory
{
    /**
     * @param string $name
     * @param int $yearOfBirth
     * @param int $yearOfDeath
     * @return President
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function createPresident(string $name, int $yearOfBirth, int $yearOfDeath): President
    {
        return new President(
            $name,
            $yearOfBirth,
            $yearOfDeath
        );
    }
}
