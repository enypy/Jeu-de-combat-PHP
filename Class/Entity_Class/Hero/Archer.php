<?php

namespace Class\Entity_Class\Hero;

use Class\Hero;
use Class\Foe;

class Archer extends Hero
{
    protected int $health = 1600;
    protected int $energy = 140;
    protected int $defence = 13;
    protected int $agility = 66;
    protected int $lifesteal = 0;
    private const HERO_CLASS = 'Archer';
    protected const MAX_HP = 1600;
    protected const MAX_ENERGY = 140;
    private const SPECIAL_ABILITY_NAME = "Arrow Rain";
    private const SPECIAL_ABILITY_COST = 86;



    // public function __construct($name)
    // {
    //     parent::__construct($name);
    // }

    public function getClass(): string
    {
        return self::HERO_CLASS;
    }

    public function specialAbility(Foe $foe): int
    {
        $this->loseEnergy(self::SPECIAL_ABILITY_COST);
        $damage = rand(370, 770);
        $foeHealth = $foe->getHealth();
        $foe->setHealth(max(0, ($foeHealth - $damage)));
        return $damage;
    }

    public function getSpecialAbilityName(): string
    {
        return self::SPECIAL_ABILITY_NAME;
    }

    public function getSpecialAbilityCost(): int
    {
        return self::SPECIAL_ABILITY_COST;
    }

    public function getMaxHp(): int
    {
        return self::MAX_HP;
    }

    public function getMaxEnergy(): int
    {
        return self::MAX_ENERGY;
    }
}
