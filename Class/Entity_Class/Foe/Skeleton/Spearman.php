<?php

namespace Class\Entity_Class\Foe\Skeleton;

use Class\Entity;
use Class\Entity_Class\Foe\Skeleton;

class Spearman extends Skeleton
{
    protected int $health = 1000;
    protected int $maxHealth = 1000;
    protected int $energy = 100;
    protected const MAX_ENERGY = 100;
    protected int $hitChance = 90;
    protected int $maxHitChance = 90;
    protected int $attack = 25;
    protected int $maxAttack = 25;
    protected int $defence = 25;
    protected int $maxDefence = 25;
    protected int $agility = 25;
    protected int $maxAgility = 25;
    protected int $lifesteal = 25;
    protected int $maxLifesteal = 25;
    protected const ENTITY_SUBCLASS = 'Spearman';
    protected const HIT_DAMAGE_TYPE = 'physical';
    protected const HIT_DISTANCE = 'melee';
    protected const HIT_MAX_DMG = 20;
    protected const HIT_MIN_DMG = 200;
    protected const HIT_COST = 10;
    protected const SPECIAL_ABILITY_NAME = 'Lorem ipsum';
    protected const SPECIAL_ABILITY_DESCRIPTION = ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos qui, dolores repellat dolor minus doloremque quis tempore corporis laborum ad veritatis aspernatur commodi debitis obcaecati similique est rerum quidem tempora.';
    protected const SPECIAL_ABILITY_COST = 100;


    public function specialAbility(Entity $entity): array
    {
        $struckHpBeforeHit = $entity->getHealth();
        $strikerHpBeforeHit = $this->getHealth();
        $energyRegen = $this->regenEnergy();
        $hitEnergyCost = $this->getHitCost();
        $tryLoseEnergy = $this->tryLoseEnergy($hitEnergyCost);
        $maxDamage = $this->getHitMaxDamage();
        $minDamage = $this->getHitMinDamage();
        $damage = $this->calculateDamage($entity, $minDamage, $maxDamage);
        $hitOrMiss = $this->hitOrMiss($entity);
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
            'actionType' => 'hit',
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
