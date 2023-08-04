<?php

namespace Class\Entity_Class\Hero\Yokai;

use Class\Entity;
use Class\Entity_Class\Hero\Yokai;

class Kitsune extends Yokai
{
    protected int $health = 1750;
    protected int $maxHealth = 1750;
    protected int $energy = 200;
    protected const MAX_ENERGY = 200;
    protected int $hitChance = 100;
    protected int $maxHitChance = 100;
    protected int $attack = 34;
    protected int $maxAttack = 34;
    protected int $defence = 22;
    protected int $maxDefence = 22;
    protected int $agility = 15;
    protected int $maxAgility = 15;
    protected int $lifesteal = 29;
    protected int $maxLifesteal = 29;
    protected const ENTITY_SUBCLASS = 'Kitsune';
    protected const HIT_DAMAGE_TYPE = 'magical';
    protected const HIT_DISTANCE = 'ranged';
    protected const HIT_MAX_DMG = 25;
    protected const HIT_MIN_DMG = 190;
    protected const HIT_COST = 10;
    protected const SPECIAL_ABILITY_NAME = 'Azure Inferno';
    protected const SPECIAL_ABILITY_DESCRIPTION = 'Harness the arcane energies to conjure a massive orb of blue fire, crackling with intense magical power. With a sweeping motion, you propel the blazing sphere towards your target from a distance, leaving a trail of sparks and embers in its wake. Upon impact, the sphere erupts in a spectacular explosion, engulfing everything in its vicinity in a brilliant azure inferno. The searing flames scorch and sear, leaving a trail of devastation in their wake.';
    protected const SPECIAL_ABILITY_COST = 160;


    public function specialAbility(Entity $entity): array
    {

        $struckHpBeforeHit = $entity->getHealth();
        $strikerHpBeforeHit = $this->getHealth();
        $energyRegen = $this->regenEnergy();
        $hitEnergyCost = $this->getSpecialAbilityCost();
        $tryLoseEnergy = $this->tryLoseEnergy($hitEnergyCost);
        $damage = $this->calculateDamage($entity, 230, 460);
        $hitOrMiss = $this->hitOrMiss($entity);
        $damageAfterBlocking = $this->blockDamage($damage);
        $damageBlocked = $damage - $damageAfterBlocking;
        $strikerPassiveAbilityTriggered = false;
        $struckPassiveAbilityTriggered = false;
        $hitSuccess = false;
        $struckCurrentHp = $entity->getHealth();
        $damageDone = false;
        $lifesteal = false;

        if ($tryLoseEnergy && $hitOrMiss) {
            $finalDamage = $entity->takeDamage($damageAfterBlocking);
            $lifesteal = $this->lifesteal($finalDamage);
            $struckPassiveAbilityTriggered = $entity->triggerWhenStruck($entity, $finalDamage);
            $struckCurrentHp = $entity->getHealth();
            $damageDone = max(0, ($struckHpBeforeHit - $struckCurrentHp));
            $strikerPassiveAbilityTriggered = $this->triggerOnHit($entity, $finalDamage);
            $hitSuccess = true;
        }


        $hitResult = [
            'actionType' => 'special ability',
            'actionName' => $this->getSpecialAbilityName(),
            'striker' => $this->getName(),
            'strikerClass' => $this->getClass(),
            'strikerSubclass' => $this->getSubclass(),
            'strikerHpBeforeHit' => $strikerHpBeforeHit,
            'strikerCurrentHp' => $this->getHealth(),
            'strikerEnergyRegen' => $energyRegen,
            'strikerPassiveAbility' => $strikerPassiveAbilityTriggered,
            'struck' => $entity->getName(),
            'struckClass' => $entity->getClass(),
            'struckSubclass' => $entity->getSubclass(),
            'struckHpBeforeHit' => $struckHpBeforeHit,
            'struckCurrentHp' => $struckCurrentHp,
            'struckPassiveAbility' => $struckPassiveAbilityTriggered,
            'damageDone' => $damageDone,
            'damageBlocked' => $damageBlocked,
            'effectName' => false,
            'effectTarget' => false,
            'hit' => $hitOrMiss,
            'hitEnergyCost' => $hitEnergyCost,
            'enoughEnergy' => $tryLoseEnergy,
            'hitSuccess' => $hitSuccess,
            'lifesteal' => $lifesteal,
        ];

        return $hitResult;
    }
}
