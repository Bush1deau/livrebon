<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="lier")
     */
    private $lier;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="Choisis")
     */
    private $Choisis;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="commander")
     */
    private $commander;

    /**
     * @ORM\OneToMany(targetEntity=Livraison::class, mappedBy="livrer")
     */
    private $livrer;

    public function __construct()
    {
        $this->commander = new ArrayCollection();
        $this->livrer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLier(): ?Secteur
    {
        return $this->lier;
    }

    public function setLier(?Secteur $lier): self
    {
        $this->lier = $lier;

        return $this;
    }

    public function getChoisis(): ?Restaurant
    {
        return $this->Choisis;
    }

    public function setChoisis(?Restaurant $Choisis): self
    {
        $this->Choisis = $Choisis;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommander(): Collection
    {
        return $this->commander;
    }

    public function addCommander(Commande $commander): self
    {
        if (!$this->commander->contains($commander)) {
            $this->commander[] = $commander;
            $commander->setCommander($this);
        }

        return $this;
    }

    public function removeCommander(Commande $commander): self
    {
        if ($this->commander->removeElement($commander)) {
            // set the owning side to null (unless already changed)
            if ($commander->getCommander() === $this) {
                $commander->setCommander(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivrer(): Collection
    {
        return $this->livrer;
    }

    public function addLivrer(Livraison $livrer): self
    {
        if (!$this->livrer->contains($livrer)) {
            $this->livrer[] = $livrer;
            $livrer->setLivrer($this);
        }

        return $this;
    }

    public function removeLivrer(Livraison $livrer): self
    {
        if ($this->livrer->removeElement($livrer)) {
            // set the owning side to null (unless already changed)
            if ($livrer->getLivrer() === $this) {
                $livrer->setLivrer(null);
            }
        }

        return $this;
    }
}
