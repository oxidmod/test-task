<?php

namespace TestTask\Model\Advertisement;

use Fleshgrinder\Core\Comparable;
use Fleshgrinder\Core\UncomparableException;

/**
 * Class SortableAdvertisement
 */
class SortableAdvertisement implements Comparable
{
    /**
     * @var Advertisement
     */
    private $advertisement;

    /**
     * SortableAdvertisement constructor.
     * @param Advertisement $advertisement
     */
    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    /**
     * @return Advertisement
     */
    public function getAdvertisement(): Advertisement
    {
        return $this->advertisement;
    }

    /**
     * {@inheritdoc}
     */
    public function compareTo($value)
    {
        $otherAdvertisement = $this->getObjectToCompare($value);
        $priceDiff = $otherAdvertisement->getPrice() - $this->advertisement->getPrice();
        if ($priceDiff === 0) {
            return $otherAdvertisement->getWeight() - $this->advertisement->getWeight();
        }
        return $priceDiff;
    }

    /**
     * @param $value
     * @return Advertisement
     * @throws UncomparableException
     */
    private function getObjectToCompare($value): Advertisement
    {
        if (!($value instanceof SortableAdvertisement)) {
            throw new UncomparableException();
        }

        return $value->getAdvertisement();
    }
}
