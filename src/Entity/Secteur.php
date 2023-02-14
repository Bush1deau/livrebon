<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecteurRepository::class)
 */
class Secteur
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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="lier")
     */
    private $lier;

    /**
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="seSitue")
     */
    private $seSitue;

    /**
     * @ORM\OneToMany(targetEntity=Livraison::class, mappedBy="etRatacher")
     */
    private $etRatacher;

    public function __construct()
    {
        $this->lier = new ArrayCollection();
        $this->seSitue = new ArrayCollection();
        $this->etRatacher = new ArrayCollection();
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
     * @return Collection<int, User>
     */
    public function getLier(): Collection
    {
        return $this->lier;
    }

    public function addLier(User $lier): self
    {
        if (!$this->lier->contains($lier)) {
            $this->lier[] = $lier;
            $lier->setLier($this);
        }

        return $this;
    }

    public function removeLier(User $lier): self
    {
        if ($this->lier->removeElement($lier)) {
            // set the owning side to null (unless already changed)
            if ($lier->getLier() === $this) {
                $lier->setLier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getSeSitue(): Collection
    {
        return $this->seSitue;
    }

    public function addSeSitue(Restaurant $seSitue): self
    {
        if (!$this->seSitue->contains($seSitue)) {
            $this->seSitue[] = $seSitue;
            $seSitue->setSeSitue($this);
        }

        return $this;
    }

    public function removeSeSitue(Restaurant $seSitue): self
    {
        if ($this->seSitue->removeElement($seSitue)) {
            // set the owning side to null (unless already changed)
            if ($seSitue->getSeSitue() === $this) {
                $seSitue->setSeSitue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getEtRatacher(): Collection
    {
        return $this->etRatacher;
    }

    public function addEtRatacher(Livraison $etRatacher): self
    {
        if (!$this->etRatacher->contains($etRatacher)) {
            $this->etRatacher[] = $etRatacher;
            $etRatacher->setEtRatacher($this);
        }

        return $this;
    }

    public function removeEtRatacher(Livraison $etRatacher): self
    {
        if ($this->etRatacher->removeElement($etRatacher)) {
            // set the owning side to null (unless already changed)
            if ($etRatacher->getEtRatacher() === $this) {
                $etRatacher->setEtRatacher(null);
            }
        }

        return $this;
    }
}
