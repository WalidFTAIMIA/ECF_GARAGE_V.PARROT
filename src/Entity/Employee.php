<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    private ?users $users = null;

    #[ORM\ManyToMany(targetEntity: opinion::class, inversedBy: 'employees')]
    private Collection $opinion;

    #[ORM\ManyToMany(targetEntity: cars::class, inversedBy: 'employees')]
    private Collection $cars;

    public function __construct()
    {
        $this->opinion = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?users
    {
        return $this->users;
    }

    public function setUsers(?users $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, opinion>
     */
    public function getOpinion(): Collection
    {
        return $this->opinion;
    }

    public function addOpinion(opinion $opinion): static
    {
        if (!$this->opinion->contains($opinion)) {
            $this->opinion->add($opinion);
        }

        return $this;
    }

    public function removeOpinion(opinion $opinion): static
    {
        $this->opinion->removeElement($opinion);

        return $this;
    }

    /**
     * @return Collection<int, cars>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(cars $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
        }

        return $this;
    }

    public function removeCar(cars $car): static
    {
        $this->cars->removeElement($car);

        return $this;
    }
}
