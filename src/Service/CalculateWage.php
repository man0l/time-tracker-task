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

        $rates = $this->repository->findRate($this->isWeekday($date));

        $wage = 0;

        if(count($rates) === 0) {
            return $wage;
        }

        /** @var Rate $rate */
        foreach($rates as $rate) {
            $diff = $rate->getToHours() - $rate->getFromHours();

            if($hours > $diff) {
              $wage += $diff * $rate->getRate();
            } else if($hours > 0) {
                $wage += $hours * $rate->getRate();
            } else {
                break;
            }

            $hours -= $diff;
        }

        if($hours>0) {
            $wage += $rate->getRate();
        }

        return (float)$wage;
    }

    private function isWeekday(\DateTime $date) {
        $dayOfTheWeek = $date->format('N');
        return $dayOfTheWeek < 6;
    }
}

