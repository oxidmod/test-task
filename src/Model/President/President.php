<?php

namespace TestTask\Model\President;

/**
 * Class President
 */
class President
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $yearOfBirth;

    /**
     * @var int
     */
    private $yearOfDeath;

    /**
     * President constructor.
     * @param string $name
     * @param int $yearOfBirth
     * @param int $yearOfDeath
     * @throws \LogicException
     */
    public function __construct(
        string $name,
        int $yearOfBirth,
        int $yearOfDeath
    ) {
        $this->name = $name;
        if ($yearOfBirth > $yearOfDeath) {
            throw new \LogicException('Year of death cannot be lower then year of birth');
        }
        $this->yearOfBirth = $yearOfBirth;
        $this->yearOfDeath = $yearOfDeath;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getYearOfBirth(): int
    {
        return $this->yearOfBirth;
    }

    /**
     * @return int
     */
    public function getYearOfDeath(): int
    {
        return $this->yearOfDeath;
    }
}
