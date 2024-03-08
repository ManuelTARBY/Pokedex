<?php

namespace App\Entity;

use App\Repository\GenerationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenerationRepository::class)]
class Generation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'generation', orphanRemoval: true)]
    private Collection $pokemon_has_generation;

    public function __construct()
    {
        $this->pokemon_has_generation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemonHasGeneration(): Collection
    {
        return $this->pokemon_has_generation;
    }

    public function addPokemonHasGeneration(Pokemon $pokemonHasGeneration): static
    {
        if (!$this->pokemon_has_generation->contains($pokemonHasGeneration)) {
            $this->pokemon_has_generation->add($pokemonHasGeneration);
            $pokemonHasGeneration->setGeneration($this);
        }

        return $this;
    }

    public function removePokemonHasGeneration(Pokemon $pokemonHasGeneration): static
    {
        if ($this->pokemon_has_generation->removeElement($pokemonHasGeneration)) {
            // set the owning side to null (unless already changed)
            if ($pokemonHasGeneration->getGeneration() === $this) {
                $pokemonHasGeneration->setGeneration(null);
            }
        }

        return $this;
    }
}
