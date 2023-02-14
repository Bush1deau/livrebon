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
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="possede")
     */
    private $possede;

    /**
     * @ORM\ManyToOne(targetEntity=Repas::class, inversedBy="contient")
     */
    private $contient;

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

    public function getPossede(): ?Commande
    {
        return $this->possede;
    }

    public function setPossede(?Commande $possede): self
    {
        $this->possede = $possede;

        return $this;
    }

    public function getContient(): ?Repas
    {
        return $this->contient;
    }

    public function setContient(?Repas $contient): self
    {
        $this->contient = $contient;

        return $this;
    }
}
