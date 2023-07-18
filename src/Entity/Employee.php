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
    private ?Users $users = null;

    #[ORM\ManyToMany(targetEntity: Opinion::class, inversedBy: 'employees')]
    private Collection $opinion;

    #[ORM\ManyToMany(targetEntity: Cars::class, inversedBy: 'employees')]
    private Collection $cars;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $name = null;

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

    public function addOpinion(Opinion $opinion): static
    {
        if (!$this->opinion->contains($opinion)) {
            $this->opinion->add($opinion);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): static
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

    public function addCar(Cars $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
        }

        return $this;
    }

    public function removeCar(Cars $car): static
    {
        $this->cars->removeElement($car);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
