<?php

namespace App\Entity;

use App\Repository\OpinionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpinionRepository::class)]
class Opinion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
     #[ORM\Column(nullable: true)]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameOpinion = null;


    #[ORM\Column(length: 255)]
    private ?string $messageOpinion = null;


    #[ORM\ManyToOne(inversedBy: 'opinions')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Users $users = null;

    #[ORM\Column]
    private ?bool $approvedOpinion = null;



    public function __toString(){
        return $this->nameOpinion;
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOpinion(): ?string
    {
        return $this->nameOpinion;
    }

    public function setNameOpinion(string $nameOpinion): static
    {
        $this->nameOpinion = $nameOpinion;

        return $this;
    }

    

    

    public function getMessageOpinion(): ?string
    {
        return $this->messageOpinion;
    }

    public function setMessageOpinion(string $messageOpinion): static
    {
        $this->messageOpinion = $messageOpinion;

        return $this;
    }


    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function isApprovedOpinion(): ?bool
    {
        return $this->approvedOpinion;
    }

    public function setApprovedOpinion(bool $approvedOpinion): static
    {
        $this->approvedOpinion = $approvedOpinion;

        return $this;
    }


    

}
