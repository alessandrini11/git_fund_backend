<?php

namespace App\Entity;

use App\Repository\SexeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SexeRepository::class)
 */
class Sexe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Adherent::class, mappedBy="sexe")
     */
    private $adherents;

    public function __construct()
    {
        $this->adherents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Adherent[]
     */
    public function getAdherents(): Collection
    {
        return $this->adherents;
    }

    public function addAdherent(Adherent $adherent): self
    {
        if (!$this->adherents->contains($adherent)) {
            $this->adherents[] = $adherent;
            $adherent->setSexe($this);
        }

        return $this;
    }

    public function removeAdherent(Adherent $adherent): self
    {
        if ($this->adherents->removeElement($adherent)) {
            // set the owning side to null (unless already changed)
            if ($adherent->getSexe() === $this) {
                $adherent->setSexe(null);
            }
        }

        return $this;
    }
}
