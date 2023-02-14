<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $status = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commander")
     */
    private $commander;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="concerne")
     */
    private $concerne;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="affecter")
     */
    private $affecter;

    /**
     * @ORM\OneToMany(targetEntity=DetailsCommande::class, mappedBy="possede")
     */
    private $possede;

    public function __construct()
    {
        $this->possede = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function setStatus(array $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCommander(): ?User
    {
        return $this->commander;
    }

    public function setCommander(?User $commander): self
    {
        $this->commander = $commander;

        return $this;
    }

    public function getConcerne(): ?Livraison
    {
        return $this->concerne;
    }

    public function setConcerne(?Livraison $concerne): self
    {
        $this->concerne = $concerne;

        return $this;
    }

    public function getAffecter(): ?Restaurant
    {
        return $this->affecter;
    }

    public function setAffecter(?Restaurant $affecter): self
    {
        $this->affecter = $affecter;

        return $this;
    }

    /**
     * @return Collection<int, DetailsCommande>
     */
    public function getPossede(): Collection
    {
        return $this->possede;
    }

    public function addPossede(DetailsCommande $possede): self
    {
        if (!$this->possede->contains($possede)) {
            $this->possede[] = $possede;
            $possede->setPossede($this);
        }

        return $this;
    }

    public function removePossede(DetailsCommande $possede): self
    {
        if ($this->possede->removeElement($possede)) {
            // set the owning side to null (unless already changed)
            if ($possede->getPossede() === $this) {
                $possede->setPossede(null);
            }
        }

        return $this;
    }
}
