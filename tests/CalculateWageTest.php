<?php

namespace App\Tests;

use App\Entity\Rate;
use PHPUnit\Framework\TestCase;
use App\Service\CalculateWage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculateWageTest extends WebTestCase
{
    private $repository;
    private $wageCalc;

    public function setUp()
    {
        self::bootKernel();
        $this->repository = self::$container->get('App\Repository\RateRepository');
        $this->wageCalc = new CalculateWage($this->repository);

    }

    public function testCalculate8HoursWeekday()
    {

        $wage  = $this->wageCalc->calculate(new \DateTime('2020-03-11 00:00:00'), 8);

        $this->assertEquals(80, $wage);
    }

    public function testCalculate11HoursWeekday()
    {

        $wage  = $this->wageCalc->calculate(new \DateTime('2020-03-11 00:00:00'), 11);

        $this->assertEquals(119, $wage);
    }

    public function testCalculate10HoursWeekday()
    {

        $wage  = $this->wageCalc->calculate(new \DateTime('2020-03-11 00:00:00'), 10);

        $this->assertEquals(106, $wage);
    }

    public function testCalculate5HoursWeekend()
    {

        $wage  = $this->wageCalc->calculate(new \DateTime('2020-03-08 00:00:00'), 10);

        $this->assertEquals(72, $wage);
    }



}
