<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RateRepository")
 */
class Rate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $from_hours;

    /**
     * @ORM\Column(type="integer")
     */
    private $to_hours;

    /**
     * @ORM\Column(type="boolean")
     */
    private $weekday;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromHours(): ?int
    {
        return $this->from_hours;
    }

    public function setFromHours(int $from_hours): self
    {
        $this->from_hours = $from_hours;

        return $this;
    }

    public function getToHours(): ?int
    {
        return $this->to_hours;
    }

    public function setToHours(int $to_hours): self
    {
        $this->to_hours = $to_hours;

        return $this;
    }

    public function getWeekday(): ?string
    {
        return $this->weekday;
    }

    public function setWeekday(string $weekday): self
    {
        $this->weekday = $weekday;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
