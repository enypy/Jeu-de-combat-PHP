<?php

namespace Class\Entity_Class\Hero;

use Class\Hero;
use Class\Foe;

class Warrior extends Hero
{
    protected int $health = 2000;
    protected int $energy = 100;
    protected int $defence = 58;
    protected int $agility = 21;
    protected int $lifesteal = 10;
    private const HERO_CLASS = 'Warrior';
    protected const MAX_HP = 2000;
    protected const MAX_ENERGY = 100;
    private const SPECIAL_ABILITY_NAME = "Skullsplitter";
    private const SPECIAL_ABILITY_COST = 78;

    public function getClass(): string
    {
        return self::HERO_CLASS;
    }

    public function specialAbility(Foe $foe): int
    {
        $this->loseEnergy(self::SPECIAL_ABILITY_COST);
        $damage = rand(380, 780);
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
