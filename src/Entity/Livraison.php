<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="livrer")
     */
    private $livrer;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="concerne")
     */
    private $concerne;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="etRatacher")
     */
    private $etRatacher;

    public function __construct()
    {
        $this->concerne = new ArrayCollection();
    }

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

    public function getLivrer(): ?User
    {
        return $this->livrer;
    }

    public function setLivrer(?User $livrer): self
    {
        $this->livrer = $livrer;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getConcerne(): Collection
    {
        return $this->concerne;
    }

    public function addConcerne(Commande $concerne): self
    {
        if (!$this->concerne->contains($concerne)) {
            $this->concerne[] = $concerne;
            $concerne->setConcerne($this);
        }

        return $this;
    }

    public function removeConcerne(Commande $concerne): self
    {
        if ($this->concerne->removeElement($concerne)) {
            // set the owning side to null (unless already changed)
            if ($concerne->getConcerne() === $this) {
                $concerne->setConcerne(null);
            }
        }

        return $this;
    }

    public function getEtRatacher(): ?Secteur
    {
        return $this->etRatacher;
    }

    public function setEtRatacher(?Secteur $etRatacher): self
    {
        $this->etRatacher = $etRatacher;

        return $this;
    }
}
