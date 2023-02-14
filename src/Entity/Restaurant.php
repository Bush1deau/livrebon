<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="Choisis")
     */
    private $Choisis;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="seSitue")
     */
    private $seSitue;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="affecter")
     */
    private $affecter;

    /**
     * @ORM\OneToMany(targetEntity=Repas::class, mappedBy="propose")
     */
    private $propose;

    public function __construct()
    {
        $this->Choisis = new ArrayCollection();
        $this->affecter = new ArrayCollection();
        $this->propose = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getChoisis(): Collection
    {
        return $this->Choisis;
    }

    public function addChoisi(User $choisi): self
    {
        if (!$this->Choisis->contains($choisi)) {
            $this->Choisis[] = $choisi;
            $choisi->setChoisis($this);
        }

        return $this;
    }

    public function removeChoisi(User $choisi): self
    {
        if ($this->Choisis->removeElement($choisi)) {
            // set the owning side to null (unless already changed)
            if ($choisi->getChoisis() === $this) {
                $choisi->setChoisis(null);
            }
        }

        return $this;
    }

    public function getSeSitue(): ?Secteur
    {
        return $this->seSitue;
    }

    public function setSeSitue(?Secteur $seSitue): self
    {
        $this->seSitue = $seSitue;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getAffecter(): Collection
    {
        return $this->affecter;
    }

    public function addAffecter(Commande $affecter): self
    {
        if (!$this->affecter->contains($affecter)) {
            $this->affecter[] = $affecter;
            $affecter->setAffecter($this);
        }

        return $this;
    }

    public function removeAffecter(Commande $affecter): self
    {
        if ($this->affecter->removeElement($affecter)) {
            // set the owning side to null (unless already changed)
            if ($affecter->getAffecter() === $this) {
                $affecter->setAffecter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getPropose(): Collection
    {
        return $this->propose;
    }

    public function addPropose(Repas $propose): self
    {
        if (!$this->propose->contains($propose)) {
            $this->propose[] = $propose;
            $propose->setPropose($this);
        }

        return $this;
    }

    public function removePropose(Repas $propose): self
    {
        if ($this->propose->removeElement($propose)) {
            // set the owning side to null (unless already changed)
            if ($propose->getPropose() === $this) {
                $propose->setPropose(null);
            }
        }

        return $this;
    }
}
