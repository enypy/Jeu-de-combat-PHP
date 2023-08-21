<?php

namespace Class\Entity_Class\Hero\Yokai;

use Class\Entity;
use Class\Entity_Class\Hero\Yokai;

class Karasu extends Yokai
{
    protected int $health = 2050;
    protected int $maxHealth = 2050;
    protected int $energy = 151;
    protected const MAX_ENERGY = 151;
    protected int $hitChance = 96;
    protected int $maxHitChance = 96;
    protected int $attack = 10;
    protected int $maxAttack = 10;
    protected int $defence = 35;
    protected int $maxDefence = 35;
    protected int $agility = 20;
    protected int $maxAgility = 20;
    protected int $lifesteal = 35;
    protected int $maxLifesteal = 35;
    protected const ENTITY_SUBCLASS = 'Karasu';
    protected const HIT_DAMAGE_TYPE = 'physical';
    protected const HIT_DISTANCE = 'melee';
    protected const HIT_MAX_DMG = 35;
    protected const HIT_MIN_DMG = 240;
    protected const HIT_COST = 8;
    protected const SPECIAL_ABILITY_NAME = 'Crimson Stab Barrage';
    protected const SPECIAL_ABILITY_DESCRIPTION = 'Execute a rapid and relentless series of short sword strikes that pierce through your foe\'s defenses with surgical precision. Each swift and calculated thrust is designed to inflict deep wounds, causing your enemy to bleed profusely from multiple lacerations. The crimson-stained blades dance through the air as you assail your target, leaving a trail of crimson drops in their wake. The inflicted wounds continue to seep blood, weakening your opponent over time and adding an element of dread to their inevitable defeat.';
    protected const SPECIAL_ABILITY_COST = 66;


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
        $hitOrMiss = $this->hitOrMiss($entity);
        $damageAfterBlocking = $damage;
        $damageBlocked = $damage - $damageAfterBlocking;
        $strikerPassiveAbilityTriggered = false;
        $struckPassiveAbilityTriggered = false;
        $hitSuccess = false;
        $struckCurrentHp = $entity->getHealth();
        $damageDone = false;
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
            $effectName = 'Bleeding';
            $entity->setEffect('Bleeding', 4);
            $hitSuccess = true;
        }


        $hitResult = [
            'actionType' => 'special ability',
            'actionName' => $this->getSpecialAbilityName(),
            'striker' => $this->getName(),
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
            'effectName' => $effectName,
            'effectTarget' => $entity->getName(),
            'hit' => $hitOrMiss,
            'hitEnergyCost' => $hitEnergyCost,
            'enoughEnergy' => $tryLoseEnergy,
            'hitSuccess' => $hitSuccess,
            'lifesteal' => $lifesteal,
        ];

        return $hitResult;
    }
}
