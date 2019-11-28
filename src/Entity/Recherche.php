<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RechercheRepository")
 */
class Recherche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RechercheTitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RechercheCategorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRechercheTitre(): ?string
    {
        return $this->RechercheTitre;
    }

    public function setRechercheTitre(?string $RechercheTitre): self
    {
        $this->RechercheTitre = $RechercheTitre;

        return $this;
    }

    public function getRechercheCategorie(): ?string
    {
        return $this->RechercheCategorie;
    }

    public function setRechercheCategorie(?string $RechercheCategorie): self
    {
        $this->RechercheCategorie = $RechercheCategorie;

        return $this;
    }
}
