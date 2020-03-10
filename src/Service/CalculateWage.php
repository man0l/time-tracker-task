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
        // take the highest rate
        /** @var Rate $rate */
        foreach($rates as $rate) {
            if($wage < $rate * $hours) {
                $wage = $rate * $hours;
            }
        }

        return (float)$wage;
    }

    private function isWeekday(\DateTime $date) {
        $dayOfTheWeek = $date->format('N');
        return $dayOfTheWeek < 6;
    }
}
