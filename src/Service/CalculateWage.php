<?php


namespace App\Service;
use App\Entity\Rate;

use App\Repository\RateRepository;

class CalculateWage
{
    private $repository;
    function __construct(RateRepository $repository)
    {
        $this->repository = $repository;
    }

    function calculate(\DateTime $date, int $hours) {

        $rates = $this->repository->findRate($hours, $this->isWeekday($date));

        $wage = 0;

        if(count($rates) === 0) {
            return $wage;
        }
        // take the highest rate, the rates are sorted ascending
        /** @var Rate $rate */
        foreach($rates as $rate) {
            $wage += $rate->getRate() * $hours;
            $hours -= $rate->getToHours();
        }

        if($hours > 0 && isset($rates[0])) {
            // if any hours left, use the default rate, which is the first rate = $rate[0]
            /** @var Rate $rate */
            $rate = $rates[0];
            $wage += $hours * $rate->getRate();
        }

        return (float)$wage;
    }

    private function isWeekday(\DateTime $date) {
        $dayOfTheWeek = $date->format('N');
        return $dayOfTheWeek < 6;
    }
}

