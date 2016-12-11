<?php

namespace TestTask\Model\Advertisement;

/**
 * Class Advertisement
 */
class Advertisement
{
    /**
     * @var string
     */
    private $image;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var int
     */
    private $price;

    /**
     * Advertisement constructor.
     * @param string $image
     * @param int $weight
     * @param int $price
     */
    public function __construct(int $price, int $weight, string $image)
    {
        $this->image = $image;
        $this->weight = $weight;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
