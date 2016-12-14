<?php

namespace TestTask\Services\President;

use TestTask\Model\President\President;
use TestTask\Repository\President\PresidentRepository;

/**
 * Class PresidentService
 */
class PresidentService
{
    /**
     * @var PresidentRepository
     */
    private $presidentRepository;

    /**
     * PresidentService constructor.
     * @param PresidentRepository $presidentRepository
     */
    public function __construct(PresidentRepository $presidentRepository)
    {
        $this->presidentRepository = $presidentRepository;
    }

    /**
     * @return array
     */
    public function calculateMaxCountOfPresidents(): array
    {
        /** @var President[] $presidents */
        $presidents = $this->presidentRepository->findAll();
        $table = $this->getInitialTable($presidents);

        foreach ($presidents as $p) {
            reset($table);
            while (key($table) != $p->getYearOfBirth()) {
                next($table);
            }

            do {
                $table[key($table)]++;
                next($table);
            } while (key($table) && key($table) <= $p->getYearOfDeath());
        }

        return $this->extractYears($table);
    }

    /**
     * @param President[] $presidents
     * @return array
     */
    private function getInitialTable(array $presidents): array
    {
        $table = array_reduce(
            $presidents,
            function (array $result, President $p) {
                $result[$p->getYearOfBirth() - 1] = 0;
                $result[$p->getYearOfBirth()] = 0;
                $result[$p->getYearOfBirth() + 1] = 0;
                $result[$p->getYearOfDeath() - 1] = 0;
                $result[$p->getYearOfDeath()] = 0;
                $result[$p->getYearOfDeath() + 1] = 0;
                return $result;
            },
            []
        );

        ksort($table);
        return $table;
    }

    /**
     * @param array $table
     * @return array
     */
    private function extractYears(array $table): array
    {
        $maxCount = call_user_func_array('max', $table);
        $points = array_keys($table);
        $pointsCount = count($points);

        $ranges = [[], []];
        for ($i = 0; $i < $pointsCount; $i++) {
            if ($table[$points[$i]] === $maxCount) {
                $rangeBegin = $points[$i];
                $rangeEnd = $i === $pointsCount - 1 ? $rangeBegin : $points[$i + 1];
                if ($table[$rangeBegin] !== $table[$rangeEnd]) {
                    $rangeEnd--;
                }

                $ranges[] = range($rangeBegin, $rangeEnd);
            }
        }

        $years = array_unique(call_user_func_array('array_merge', $ranges));
        return array_fill_keys($years, $maxCount);

    }
}
