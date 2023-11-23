<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarsRepository::class)]
class Cars
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $carsBrand = null;

    #[ORM\Column(length: 100)]
    private ?string $carsModel = null;

    #[ORM\Column]
    private ?float $carsPrice = null;

    #[ORM\Column]
    private ?int $carsKm = null;

    #[ORM\Column(length: 100)]
    private ?string $carsEnergy = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $carsYear = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Employee::class, mappedBy: 'cars')]
    private Collection $employees;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionCars = null;

    #[ORM\ManyToOne(targetEntity: CarsCatalogue::class, inversedBy: 'cars')]
    private ?CarsCatalogue $carscatalogue = null;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarsBrand(): ?string
    {
        return $this->carsBrand;
    }

    public function setCarsBrand(string $carsBrand): static
    {
        $this->carsBrand = $carsBrand;

        return $this;
    }

    public function getCarsModel(): ?string
    {
        return $this->carsModel;
    }

    public function setCarsModel(string $carsModel): static
    {
        $this->carsModel = $carsModel;

        return $this;
    }

    public function getCarsPrice(): ?float
    {
        return $this->carsPrice;
    }

    public function setCarsPrice(float $carsPrice): static
    {
        $this->carsPrice = $carsPrice;

        return $this;
    }

    public function getCarsKm(): ?int
    {
        return $this->carsKm;
    }

    public function setCarsKm(int $carsKm): static
    {
        $this->carsKm = $carsKm;

        return $this;
    }

    public function getCarsEnergy(): ?string
    {
        return $this->carsEnergy;
    }

    public function setCarsEnergy(string $carsEnergy): static
    {
        $this->carsEnergy = $carsEnergy;

        return $this;
    }

    public function getCarsYear(): ?\DateTimeInterface
    {
        return $this->carsYear;
    }

    public function setCarsYear(\DateTimeInterface $carsYear): static
    {
        $this->carsYear = $carsYear;

        return $this;
    }

    

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->addCar($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            $employee->removeCar($this);
        }

        return $this;
    }

    public function getDescriptionCars(): ?string
    {
        return $this->descriptionCars;
    }

    public function setDescriptionCars(?string $descriptionCars): static
    {
        $this->descriptionCars = $descriptionCars;

        return $this;
    }
    public function setCarscatalogue(?CarsCatalogue $carscatalogue): self
    {
        $this->carscatalogue = $carscatalogue;

        return $this;
    }

    public function getCarscatalogue(): ?CarsCatalogue
    {
        return $this->carscatalogue;
    }

    
}
