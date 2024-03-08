<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $logo = null;

    #[ORM\ManyToMany(targetEntity: Pokemon::class, inversedBy: 'pokemon_has_type')]
    private Collection $pokemon_has_type;

    public function __construct()
    {
        $this->pokemon_has_type = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemonHasType(): Collection
    {
        return $this->pokemon_has_type;
    }

    public function addPokemonHasType(Pokemon $pokemonHasType): static
    {
        if (!$this->pokemon_has_type->contains($pokemonHasType)) {
            $this->pokemon_has_type->add($pokemonHasType);
        }

        return $this;
    }

    public function removePokemonHasType(Pokemon $pokemonHasType): static
    {
        $this->pokemon_has_type->removeElement($pokemonHasType);

        return $this;
    }
}
