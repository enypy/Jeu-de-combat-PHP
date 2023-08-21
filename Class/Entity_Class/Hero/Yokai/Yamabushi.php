<?php

namespace Class\Entity_Class\Hero\Yokai;

use Class\Entity;
use Class\Entity_Class\Hero\Yokai;

class Yamabushi extends Yokai
{
    protected int $health = 2200;
    protected int $maxHealth = 2200;
    protected int $energy = 133;
    protected const MAX_ENERGY = 133;
    protected int $hitChance = 95;
    protected int $maxHitChance = 95;
    protected int $attack = 25;
    protected int $maxAttack = 25;
    protected int $defence = 18;
    protected int $maxDefence = 18;
    protected int $agility = 30;
    protected int $maxAgility = 30;
    protected int $lifesteal = 27;
    protected int $maxLifesteal = 27;
    protected const ENTITY_SUBCLASS = 'Yamabushi';
    protected const HIT_DAMAGE_TYPE = 'physical';
    protected const HIT_DISTANCE = 'melee';
    protected const HIT_MAX_DMG = 33;
    protected const HIT_MIN_DMG = 230;
    protected const HIT_COST = 9;
    protected const SPECIAL_ABILITY_NAME = 'Blade Flurry';
    protected const SPECIAL_ABILITY_DESCRIPTION = 'Unleash a rapid flurry of short sword strikes, creating a whirlwind of blades that slice through enemies with lightning speed and precision. Each strike is executed with finesse and agility, making it difficult for foes to anticipate or block the onslaught.';
    protected const SPECIAL_ABILITY_COST = 60;


    public function specialAbility(Entity $entity): array
    {

        $struckHpBeforeHit = $entity->getHealth();
        $strikerHpBeforeHit = $this->getHealth();
        $strikerEnergyBeforeHit = $this->getEnergy();
        $struckEnergyBeforeHit = $entity->getEnergy();
        $energyRegen = $this->regenEnergy();
        $hitEnergyCost = $this->getSpecialAbilityCost();
        $tryLoseEnergy = $this->tryLoseEnergy($hitEnergyCost);
        $damage = $this->calculateDamage($entity, 230, 460);
        $hitOrMiss = true;
        $damageAfterBlocking = $this->blockDamage($damage);
        $damageBlocked = $damage - $damageAfterBlocking;
        $strikerPassiveAbilityTriggered = false;
        $struckPassiveAbilityTriggered = false;
        $struckCurrentHp = $entity->getHealth();
        $damageDone = false;
        $lifesteal = false;
        $hitSuccess = false;

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
            'hitDamageType' => $this->getHitDamageType(),
            'hitDistance' => $this->getHitDistance(),
            'actionName' => $this->getSpecialAbilityName(),
            'striker' => $this->getName(),
            'strikerId' => $this->getId(),
            'strikerEntityType' => $this->getType(),
            'strikerClass' => $this->getClass(),
            'strikerSubclass' => $this->getSubclass(),
            'strikerHpBeforeHit' => $strikerHpBeforeHit,
            'strikerCurrentHp' => $this->getHealth(),
            'strikerEnergyBeforeHit' => $strikerEnergyBeforeHit,
            'strikerEnergyRegen' => $energyRegen,
            'strikerCurrentEnergy' => $this->getEnergy(),
            'strikerPassiveAbility' => $strikerPassiveAbilityTriggered,
            'struck' => $entity->getName(),
            'struckId' => $entity->getId(),
            'struckEntityType' => $entity->getType(),
            'struckClass' => $entity->getClass(),
            'struckSubclass' => $entity->getSubclass(),
            'struckHpBeforeHit' => $struckHpBeforeHit,
            'struckCurrentHp' => $struckCurrentHp,
            'struckEnergyBeforeHit'=> $struckEnergyBeforeHit,
            'struckCurrentEnergy' => $entity->getEnergy(),
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
