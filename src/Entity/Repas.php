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
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="repas")
     */
    private $restaurant;

    /**
     * @ORM\OneToMany(targetEntity=DetailsCommande::class, mappedBy="repas")
     */
    private $detailscommandes;

    public function __construct()
    {
        $this->detailscommandes = new ArrayCollection();
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

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection<int, DetailsCommande>
     */
    public function getDetailscommandes(): Collection
    {
        return $this->detailscommandes;
    }

    public function addDetailscommande(DetailsCommande $detailscommande): self
    {
        if (!$this->detailscommandes->contains($detailscommande)) {
            $this->detailscommandes[] = $detailscommande;
            $detailscommande->setRepas($this);
        }

        return $this;
    }

    public function removeDetailscommande(DetailsCommande $detailscommande): self
    {
        if ($this->detailscommandes->removeElement($detailscommande)) {
            // set the owning side to null (unless already changed)
            if ($detailscommande->getRepas() === $this) {
                $detailscommande->setRepas(null);
            }
        }

        return $this;
    }


  
}
