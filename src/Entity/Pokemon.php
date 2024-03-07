<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pokedex_id = null;

    #[ORM\Column(length: 45)]
    private ?string $category = null;

    #[ORM\Column(length: 100)]
    private ?string $name_fr = null;

    #[ORM\Column(length: 100)]
    private ?string $name_en = null;

    #[ORM\Column(length: 100)]
    private ?string $name_jp = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $sprite_regular = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $sprite_shiny = null;

    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\Column]
    private ?int $atk = null;

    #[ORM\Column]
    private ?int $def = null;

    #[ORM\Column]
    private ?int $spe_atk = null;

    #[ORM\Column]
    private ?int $spe_def = null;

    #[ORM\Column]
    private ?int $vit = null;

    #[ORM\Column]
    private ?string $height = null;

    #[ORM\Column(length: 10)]
    private ?string $weight = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokedexId(): ?int
    {
        return $this->pokedex_id;
    }

    public function setPokedexId(int $pokedex_id): static
    {
        $this->pokedex_id = $pokedex_id;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getNameFr(): ?string
    {
        return $this->name_fr;
    }

    public function setNameFr(string $name_fr): static
    {
        $this->name_fr = $name_fr;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(string $name_en): static
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getNameJp(): ?string
    {
        return $this->name_jp;
    }

    public function setNameJp(string $name_jp): static
    {
        $this->name_jp = $name_jp;

        return $this;
    }

    public function getSpriteRegular(): ?string
    {
        return $this->sprite_regular;
    }

    public function setSpriteRegular(string $sprite_regular): static
    {
        $this->sprite_regular = $sprite_regular;

        return $this;
    }

    public function getSpriteShiny(): ?string
    {
        return $this->sprite_shiny;
    }

    public function setSpriteShiny(string $sprite_shiny): static
    {
        $this->sprite_shiny = $sprite_shiny;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAtk(): ?int
    {
        return $this->atk;
    }

    public function setAtk(int $atk): static
    {
        $this->atk = $atk;

        return $this;
    }

    public function getDef(): ?int
    {
        return $this->def;
    }

    public function setDef(int $def): static
    {
        $this->def = $def;

        return $this;
    }

    public function getSpeAtk(): ?int
    {
        return $this->spe_atk;
    }

    public function setSpeAtk(int $spe_atk): static
    {
        $this->spe_atk = $spe_atk;

        return $this;
    }

    public function getSpeDef(): ?int
    {
        return $this->spe_def;
    }

    public function setSpeDef(int $spe_def): static
    {
        $this->spe_def = $spe_def;

        return $this;
    }

    public function getVit(): ?int
    {
        return $this->vit;
    }

    public function setVit(int $vit): static
    {
        $this->vit = $vit;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }
}
