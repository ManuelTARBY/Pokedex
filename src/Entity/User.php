<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(
    operations: [
        new GetCollection()
    ]
)]

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse mail est déjà utilisée')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\Email(
        message: "Merci d'entrer une adresse mail valide."
    )]
    #[Assert\Length(
        max: 60,
        maxMessage: "L'adresse mail ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(
        max: 30,
        maxMessage: "Le pseudo ne peut pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z0-9]+$/",
        match:   true,
        message: "Le pseudo ne peut contenir que des lettres et des chiffres."
    )]
    private ?string $pseudo = null;

    #[ORM\OneToMany(targetEntity: Caught::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $caught;

    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'user')]
    private Collection $team;

    public function __construct()
    {
        $this->caught = new ArrayCollection();
        $this->team = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return Collection<int, Caught>
     */
    public function getCaught(): Collection
    {
        return $this->caught;
    }

    public function getNumberOfCaught(): ?int
    {
        $caughts = $this->getCaught();
        return count($caughts);
    }

    public function addCaught(Caught $caught): static
    {
        if (!$this->caught->contains($caught)) {
            $this->caught->add($caught);
            $caught->setUser($this);
        }

        return $this;
    }

    public function removeCaught(Caught $caught): static
    {
        if ($this->caught->removeElement($caught)) {
            // set the owning side to null (unless already changed)
            if ($caught->getUser() === $this) {
                $caught->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeam(): Collection
    {
        return $this->team;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->team->contains($team)) {
            $this->team->add($team);
            $team->setUser($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->team->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getUser() === $this) {
                $team->setUser(null);
            }
        }

        return $this;
    }
}
