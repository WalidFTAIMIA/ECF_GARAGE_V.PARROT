<?php

namespace App\Entity;

use App\Repository\TimesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimesRepository::class)]
class Times
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $morningOpeningTime;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $morningClosingTime;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $afternoonOpeningTime;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $afternoonClosingTime;

    #[ORM\ManyToOne(inversedBy: 'times')]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getMorningOpeningTime(): ?string
    {
        return $this->morningOpeningTime;
    }

    public function setMorningOpeningTime(?string $morningOpeningTime): self
    {
        $this->morningOpeningTime = $morningOpeningTime;

        return $this;
    }

    public function getMorningClosingTime(): ?string
    {
        return $this->morningClosingTime;
    }

    public function setMorningClosingTime(?string $morningClosingTime): self
    {
        $this->morningClosingTime = $morningClosingTime;

        return $this;
    }

    public function getAfternoonOpeningTime(): ?string
    {
        return $this->afternoonOpeningTime;
    }

    public function setAfternoonOpeningTime(?string $afternoonOpeningTime): self
    {
        $this->afternoonOpeningTime = $afternoonOpeningTime;

        return $this;
    }

    public function getAfternoonClosingTime(): ?string
    {
        return $this->afternoonClosingTime;
    }

    public function setAfternoonClosingTime(?string $afternoonClosingTime): self
    {
        $this->afternoonClosingTime = $afternoonClosingTime;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
