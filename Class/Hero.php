<?php

namespace Class;

abstract class Hero
{

    private int $id;
    protected int $health;
    protected int $energy;
    protected int $defence;
    protected int $agility;
    protected int $lifesteal;
    private int $lvl = 0;
    protected const MAX_HP = 0;
    protected const MAX_ENERGY = 0;


    public function __construct(
        private string $name,

    ) {
        $this->setName($name);
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setHealth(int $health): void
    {
        $this->health = max(0, $health);
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setEnergy(int $energy): void
    {
        $this->energy = max(0, $energy);
    }

    public function getEnergy(): int
    {
        return $this->energy;
    }

    public function setDefence(int $defence): void
    {
        $this->defence = max(0, $defence);
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function setAgility(int $agility): void
    {
        $this->agility = max(0, $agility);
    }

    public function getAgility(): int
    {
        return $this->agility;
    }

    public function setLvl(int $lvl): void
    {
        $this->lvl = max(0, $lvl);
    }

    public function getLvl(): int
    {
        return $this->lvl;
    }

    public function setLifesteal(int $lifesteal): void
    {
        $this->lifesteal = max(0, $lifesteal);
    }

    public function getLifesteal(): int
    {
        return $this->lifesteal;
    }

    public function hit(Foe $foe): int
    {
        $this->loseEnergy(5);
        $damage = rand(10, 500);
        $foeHealth = $foe->getHealth();
        $foe->setHealth(max(0, ($foeHealth - $damage)));
        return $damage;
    }

    public function gainEnergy(int $energy): void
    {
        $energy = $this->energy += $energy;
        $this->energy = min($this::MAX_ENERGY, $energy);
    }

    public function gainHealth(int $health): void
    {
        $health = $this->health += $health;
        $this->health = min($this::MAX_HP, $health);
    }

    public function loseEnergy(int $energy): void
    {
        $energy = $this->energy -= $energy;
        $this->energy = max(0, $energy);
    }

    public function gainDefence(int $defence): void
    {
        $this->defence += $defence;
    }

    public function loseDefence(int $defence): void
    {
        $defence = $this->defence -= $defence;
        $this->defence = max(0, $defence);
    }

    public function gainAgility(int $agility): void
    {
        $this->agility += $agility;
    }

    public function loseAgility(int $agility): void
    {
        $agility = $this->agility -= $agility;
        $this->agility = max(0, $agility);
    }

    public function gainLifesteal(int $lifesteal): void
    {
        $this->lifesteal += $lifesteal;
    }

    public function gainLvl(): void
    {
        $this->lvl += 1;
    }

    abstract function getClass(): string;
    abstract function specialAbility(Foe $foe): int;
    abstract function getSpecialAbilityName(): string;
    abstract function getSpecialAbilityCost(): int;
    abstract function getMaxHp(): int;
    abstract function getMaxEnergy(): int;
}
