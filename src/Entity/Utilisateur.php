<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $DateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $Datelocation;

    /**
     * @ORM\Column(type="integer")
     */
    private $Duree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?int
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(int $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDatelocation(): ?int
    {
        return $this->Datelocation;
    }

    public function setDateLocation(int $Datelocation): self
    {
        $this->Date = $Datelocation;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->Duree;
    }

    public function setDuree(int $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }
}
