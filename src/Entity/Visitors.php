<?php

namespace App\Entity;

use App\Repository\VisitorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitorsRepository::class)]
class Visitors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameVisitors = null;

    #[ORM\Column(length: 255)]
    private ?string $emailVisitors = null;

    #[ORM\Column]
    private ?int $phoneVisitors = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pictureVisitors = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameVisitors(): ?string
    {
        return $this->nameVisitors;
    }

    public function setNameVisitors(string $nameVisitors): static
    {
        $this->nameVisitors = $nameVisitors;

        return $this;
    }

    public function getEmailVisitors(): ?string
    {
        return $this->emailVisitors;
    }

    public function setEmailVisitors(string $emailVisitors): static
    {
        $this->emailVisitors = $emailVisitors;

        return $this;
    }

    public function getPhoneVisitors(): ?int
    {
        return $this->phoneVisitors;
    }

    public function setPhoneVisitors(int $phoneVisitors): static
    {
        $this->phoneVisitors = $phoneVisitors;

        return $this;
    }


    

    public function getPictureVisitors(): ?string
    {
        return $this->pictureVisitors;
    }

    public function setPictureVisitors(?string $pictureVisitors): static
    {
        $this->pictureVisitors = $pictureVisitors;

        return $this;
    }

}
