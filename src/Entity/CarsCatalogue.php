<?php

namespace App\Entity;

use App\Repository\CarsCatalogueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarsCatalogueRepository::class)]
class CarsCatalogue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pictureCarsCatalogue = null;

    #[ORM\OneToMany(mappedBy: 'carscatalogue', targetEntity: Cars::class)]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureCarsCatalogue(): ?string
    {
        return $this->pictureCarsCatalogue;
    }

    public function setPictureCarsCatalogue(string $pictureCarsCatalogue): static
    {
        $this->pictureCarsCatalogue = $pictureCarsCatalogue;

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
            $car->setCarscatalogue($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): static
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getCarscatalogue() === $this) {
                $car->setCarscatalogue(null);
            }
        }

        return $this;
    }
}
