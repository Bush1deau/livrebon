<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choixRepas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeVehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getChoixRepas(): ?string
    {
        return $this->choixRepas;
    }

    public function setChoixRepas(string $choixRepas): self
    {
        $this->choixRepas = $choixRepas;

        return $this;
    }

    public function getTypeVehicule(): ?string
    {
        return $this->typeVehicule;
    }

    public function setTypeVehicule(string $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }
}
