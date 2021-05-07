<?php

namespace App\Entity;

use App\Repository\DepotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepotRepository::class)
 */
class Depot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="depots")
     */
    private $adherents;

    /**
     * @ORM\ManyToOne(targetEntity=Somme::class, inversedBy="depots")
     */
    private $somme;

    /**
     * @ORM\ManyToOne(targetEntity=Date::class, inversedBy="depots")
     */
    private $date;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }
    public function getMonth()
    {
        return $this->created_at->format('M');
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getAdherents(): ?Adherent
    {
        return $this->adherents;
    }

    public function setAdherents(?Adherent $adherents): self
    {
        $this->adherents = $adherents;

        return $this;
    }

    public function getSomme(): ?Somme
    {
        return $this->somme;
    }

    public function setSomme(?Somme $somme): self
    {
        $this->somme = $somme;

        return $this;
    }

    public function getDate(): ?Date
    {
        return $this->date;
    }

    public function setDate(?Date $date): self
    {
        $this->date = $date;

        return $this;
    }
}
