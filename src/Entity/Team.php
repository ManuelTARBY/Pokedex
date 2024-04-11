<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'team')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Pokemon::class, inversedBy: 'team')]
    private Collection $pokemon_as_team;

    public function __construct()
    {
        $this->pokemon_as_team = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemonAsTeam(): Collection
    {
        return $this->pokemon_as_team;
    }

    public function addPokemonAsTeam(Pokemon $pokemonAsTeam): static
    {
        // if (!$this->pokemon_as_team->contains($pokemonAsTeam)) {
        //     $this->pokemon_as_team->add($pokemonAsTeam);
        // }
            $this->pokemon_as_team->add($pokemonAsTeam);

        return $this;
    }

    public function removePokemonAsTeam(Pokemon $pokemonAsTeam): static
    {
        $this->pokemon_as_team->removeElement($pokemonAsTeam);

        return $this;
    }
}
