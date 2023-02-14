<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RepasRepository::class)
 */
class Repas
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="propose")
     */
    private $propose;

    /**
     * @ORM\OneToMany(targetEntity=DetailsCommande::class, mappedBy="contient")
     */
    private $contient;

    public function __construct()
    {
        $this->contient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPropose(): ?Restaurant
    {
        return $this->propose;
    }

    public function setPropose(?Restaurant $propose): self
    {
        $this->propose = $propose;

        return $this;
    }

    /**
     * @return Collection<int, DetailsCommande>
     */
    public function getContient(): Collection
    {
        return $this->contient;
    }

    public function addContient(DetailsCommande $contient): self
    {
        if (!$this->contient->contains($contient)) {
            $this->contient[] = $contient;
            $contient->setContient($this);
        }

        return $this;
    }

    public function removeContient(DetailsCommande $contient): self
    {
        if ($this->contient->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getContient() === $this) {
                $contient->setContient(null);
            }
        }

        return $this;
    }
}
