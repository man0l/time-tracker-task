<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkingTimeRepository")
 */
class WorkingTime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $day_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $hours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="workingTimes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="float")
     */
    private $wagePerDay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayAt(): ?\DateTimeInterface
    {
        return $this->day_at;
    }

    public function setDayAt(\DateTimeInterface $day_at): self
    {
        $this->day_at = $day_at;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getWagePerDay(): ?float
    {
        return $this->wagePerDay;
    }

    public function setWagePerDay(float $wagePerDay): self
    {
        $this->wagePerDay = $wagePerDay;

        return $this;
    }
}
