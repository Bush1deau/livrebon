<?php

namespace App\Entity;

use App\Repository\DetailsCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailsCommandeRepository::class)
 */
class DetailsCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantité;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="details")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=Repas::class, inversedBy="detailscommandes")
     */
    private $repas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(int $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getRepas(): ?Repas
    {
        return $this->repas;
    }

    public function setRepas(?Repas $repas): self
    {
        $this->repas = $repas;

        return $this;
    }

  
}
