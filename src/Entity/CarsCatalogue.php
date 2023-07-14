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

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 20)]
    private ?string $title = null;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
