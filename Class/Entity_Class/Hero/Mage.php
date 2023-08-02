<?php

namespace Class\Entity_Class\Hero;

use Class\Hero;
use Class\Foe;

class Mage extends Hero
{
    protected int $health = 1300;
    protected int $energy = 170;
    protected int $defence = 33;
    protected int $agility = 36;
    protected int $lifesteal = 0;
    private const HERO_CLASS = 'Mage';
    protected const MAX_HP = 1300;
    protected const MAX_ENERGY = 170;
    private const SPECIAL_ABILITY_NAME = "Blazing Bolt";
    private const SPECIAL_ABILITY_COST = 120;

    public function getClass(): string
    {
        return self::HERO_CLASS;
    }

    public function specialAbility(Foe $foe): int
    {
        $this->loseEnergy(self::SPECIAL_ABILITY_COST);
        $damage = rand(600, 1200);
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
