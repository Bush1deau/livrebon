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
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="secteur")
     */
    private $restaurants;

    /**
     * @ORM\OneToMany(targetEntity=Livraison::class, mappedBy="secteur")
     */
    private $livraisons;

    public function __construct()
    {
        $this->lier = new ArrayCollection();
        $this->restaurants = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
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
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->setSecteur($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getSecteur() === $this) {
                $restaurant->setSecteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setSecteur($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getSecteur() === $this) {
                $livraison->setSecteur(null);
            }
        }

        return $this;
    }

   

}
