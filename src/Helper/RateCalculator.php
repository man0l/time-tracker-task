<?php


namespace App\Helper;


class RateCalculator
{
    const NORMAL_RATE_HOURS = 8;

    static function calculate(\DateTime $date, int $hours = 0, int $baseRate = 0, float $weekdayOvertimeRate = 0, float $weekendOvertimeRate = 0) {
        $weekday =  static::isWeekday($date);

        if($weekday) {
            return $hours > static::NORMAL_RATE_HOURS ?
                ($hours - static::NORMAL_RATE_HOURS) * $weekdayOvertimeRate + static::NORMAL_RATE_HOURS * $baseRate :
                ($hours *  $baseRate)
                ;
        } else {
            return $hours * $weekendOvertimeRate;
        }
    }

    static private function isWeekday(\DateTime $date) {
        $dayOfTheWeek = $date->format('N');
        return $dayOfTheWeek < 6;
    }
}
