<?php

namespace App\Entity;

use App\Repository\AbilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbilityRepository::class)]
class Ability
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $hidden = null;

    #[ORM\ManyToMany(targetEntity: Pokemon::class, inversedBy: 'pokemon_has_ability')]
    private Collection $pokemon_has_ability;

    public function __construct()
    {
        $this->pokemon_has_ability = new ArrayCollection();
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

    public function isHidden(): ?bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemonHasAbility(): Collection
    {
        return $this->pokemon_has_ability;
    }

    public function addPokemonHasAbility(Pokemon $pokemonHasAbility): static
    {
        if (!$this->pokemon_has_ability->contains($pokemonHasAbility)) {
            $this->pokemon_has_ability->add($pokemonHasAbility);
        }

        return $this;
    }

    public function removePokemonHasAbility(Pokemon $pokemonHasAbility): static
    {
        $this->pokemon_has_ability->removeElement($pokemonHasAbility);

        return $this;
    }
}
