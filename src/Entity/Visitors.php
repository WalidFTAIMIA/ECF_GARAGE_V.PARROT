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

    #[ORM\OneToMany(mappedBy: 'visitors', targetEntity: Cars::class)]
    private Collection $cars;

    #[ORM\ManyToMany(targetEntity: Opinion::class, mappedBy: 'visitors')]
    private Collection $opinions;

   

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->opinions = new ArrayCollection();
        
    }

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

    /**
     * @return Collection<int, Cars>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setVisitors($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): static
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getVisitors() === $this) {
                $car->setVisitors(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Opinion>
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinion $opinion): static
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions->add($opinion);
            $opinion->addVisitor($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): static
    {
        if ($this->opinions->removeElement($opinion)) {
            $opinion->removeVisitor($this);
        }

        return $this;
    }

}
