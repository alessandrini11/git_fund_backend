<?php


namespace App\Entity;


class AdherentFiltre
{
    /**
     * @var string | null
     */
    private $nom;

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }


    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

}