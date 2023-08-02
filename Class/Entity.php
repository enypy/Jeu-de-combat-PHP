<?php

namespace Class;

use Class\Entity as ClassEntity;

abstract class Entity
{

    protected int $id;
    protected int $health;
    protected const MAX_HP = 0;
    protected int $energy;
    protected const MAX_ENERGY = 0;
    protected int $hitChance;
    protected int $damage;
    protected int $defence;
    protected int $agility;
    protected int $lifesteal;
    protected const ENTITY_CLASS = '';
    protected const ENTITY_SUBCLASS = '';
    protected const ENTITY_TYPE = '';
    protected const HIT_DAMAGE_TYPE = 'physical';
    protected const HIT_DISTANCE = 'melee';
    protected const HIT_MAX_DMG = 0;
    protected const HIT_MIN_DMG = 0;
    protected const HIT_COST = 0;
    protected const SPECIAL_ABILITY_NAME = '';
    protected const SPECIAL_ABILITY_COST = 0;
    protected const PASSIVE_ABILITY_NAME = '';
    protected const PASSIVE_ABILITY_DESCRIPTION = '';
    protected const PASSIVE_ABILITY_TRIGGER_TYPE = 'on hit';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 0;
    protected const WORST_ENEMY = '';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1;
    protected array $effect = [
        'distracted' => 0,
        'slowed' => 0,
        'stunned' => 0,
        'infected' => 0,
        'dazed' => 0,
        'disarmed' => 0,

    ];

//     renvoi dégats
// absorber dégats
// lifesteal
// doubledamage
// berserk
// greatermanaregen
// stun on hit
// energysteal
// dot

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

    public function setDamage(int $damage): void
    {
        $this->damage = max(0, $damage);
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setDefence(int $defence): void
    {
        $this->defence = max(0, $defence);
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function setHitChance(int $hitChance): void
    {
        $this->hitChance = max(0, $hitChance);
    }

    public function getHitChance(): int
    {
        return $this->hitChance;
    }

    public function setAgility(int $agility): void
    {
        $this->agility = max(0, $agility);
    }

    public function getAgility(): int
    {
        return $this->agility;
    }

    public function setLifesteal(int $lifesteal): void
    {
        $this->lifesteal = max(0, $lifesteal);
    }

    public function getLifesteal(): int
    {
        return $this->lifesteal;
    }

    public function gainEnergy(int $energy): int
    {
        $energyBeforeGain = $this->energy;
        $energy = $this->energy += $energy;
        $this->energy = min($this::MAX_ENERGY, $energy);
        $currentEnergy = $this->getEnergy();
        $energyGained = $currentEnergy - $energyBeforeGain;
        return $energyGained;
    }

    public function tryLoseEnergy(int $energy): bool
    {
        $currentEnergy = $this->getEnergy();

        if ($energy > $currentEnergy) {
            return false;
        } else {
            $energy = $this->energy -= $energy;
            $this->energy = max(0, $energy);
            return true;
        }
    }

    public function heal(int $health): int
    {
        $healthBeforeGain = $this->health;
        $health = $this->health += $health;
        $this->health = min($this::MAX_HP, $health);
        $currentHealth = $this->getHealth();
        $healthGained = $currentHealth - $healthBeforeGain;
        return $healthGained;
    }

    public function takeDamage(int $health): void
    {
        $health = $this->health += $health;
        $this->health = max(0, $health);
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

    public function getSpecialAbilityName(): string
    {
        return $this::SPECIAL_ABILITY_NAME;
    }

    public function getSpecialAbilityCost(): int
    {
        return $this::SPECIAL_ABILITY_COST;
    }

    public function getMaxHp(): int
    {
        return $this::MAX_HP;
    }

    public function getMaxEnergy(): int
    {
        return $this::MAX_ENERGY;
    }

    public function getClass(): string
    {
        return $this::ENTITY_CLASS;
    }


    public function getSubclass(): string
    {
        return $this::ENTITY_SUBCLASS;
    }

    public function getType(): string
    {
        return $this::ENTITY_TYPE;
    }

    public function getPassiveAbilityName(): string
    {
        return $this::PASSIVE_ABILITY_NAME;
    }

    public function getPassiveAbilityDescription(): string
    {
        return $this::PASSIVE_ABILITY_DESCRIPTION;
    }

    public function getPassiveAbilityTriggerChance(): int
    {
        return $this::PASSIVE_ABILITY_TRIGGER_CHANCE;
    }

    public function getHitMaxDamage(): int
    {
        return $this::HIT_MAX_DMG;
    }

    public function getHitMinDamage(): int
    {
        return $this::HIT_MIN_DMG;
    }

    public function getHitDamageType(): string
    {
        return $this::HIT_DAMAGE_TYPE;
    }

    public function getHitDistance(): string
    {
        return $this::HIT_DISTANCE;
    }

    public function getHitCost(): int
    {
        return $this::HIT_COST;
    }

    public function getWorstEnemy(): string
    {
        return $this::WORST_ENEMY;
    }

    public function getWorstEnemyDamageMultiplier(): string
    {
        return $this::WORST_ENEMY_DAMAGE_MULTIPLIER;
    }

    public function getPassiveAbilityTriggerType(): string
    {
        return $this::PASSIVE_ABILITY_TRIGGER_TYPE;
    }

    public function setEffect(string $effectName, int $rounds): void
    {
        $this->effect[$effectName] = $rounds;
    }


    public function effectCountdown(): void
    {
        foreach ($this->effect as $key => $value) {
            $this->effect[$key] = max(0, --$value);
        }
    }

    protected function hitOrMiss(Entity $entity): bool
    {
        $damageType = $this->getHitDamageType();
        if ($damageType !== 'magical') {
            $hitChance = $this->getHitChance();
            $agility = $entity->getAgility();
            $dodgeChance = $agility / 10;
            $missChance = max(0, (100 - $hitChance));
            $totalDodgeChance = $dodgeChance + $missChance;

            $rand = rand(0, 100);

            if ($rand > $totalDodgeChance) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    protected function blockDamage(int $incomingDamage): int
    {
        $hitDistance = $this->getHitDistance();
        if ($hitDistance !== 'ranged') {
            $defence = $this->getDefence();
            $damageReductionPercent = $defence / 10;
            $damage = floor($incomingDamage - ($incomingDamage * ($damageReductionPercent / 100)));
            return $damage;
        } else {
            return $incomingDamage;
        }
    }

    protected function triggerOnHit(): bool
    {
        $triggerType = $this->getPassiveAbilityTriggerType();
        if ($triggerType === 'on hit') {
            $triggerChance = $this->getPassiveAbilityTriggerChance();
            $rand = rand(0, 100);

            if ($rand > $triggerChance) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    protected function triggerWhenStruck(Entity $entity): bool
    {
        $triggerType = $entity->getPassiveAbilityTriggerType();
        if ($triggerType === 'when struck') {
            $triggerChance = $this->getPassiveAbilityTriggerChance();
            $rand = rand(0, 100);

            if ($rand > $triggerChance) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    protected function calculateDamage(Entity $entity): int
    {
        $worstEnemy = $this->getWorstEnemy();
        $enemyClass = $entity->getClass();
        $maxDamage = $this->getHitMaxDamage();
        $minDamage = $this->getHitMinDamage();
        $damage = rand($minDamage, $maxDamage);

        if ($worstEnemy === $enemyClass) {
            $damageMultiplier = $this->getWorstEnemyDamageMultiplier();
            $damage = ceil($damage * $damageMultiplier);
        }

        return $damage;
    }

    protected function lifesteal(int $damage): int
    {
        $lifeSteal = $this->getLifesteal();
        $heal = ceil($damage - ($damage * ($lifeSteal / 10) / 100));
        $healed = $this->heal($heal);

        return  $healed;
    }

    public function hit(Entity $entity): array
    {
        $struckHpBeforeHit = $entity->getHealth();
        $hitEnergyCost = $this->getHitCost();
        $tryLoseEnergy = $this->tryLoseEnergy($hitEnergyCost);
        $damage = $this->calculateDamage($entity);
        $hitOrMiss = $this->hitOrMiss($entity);
        $damageAfterBlocking = $this->blockDamage($damage);
        $strikerPassiveAbilityTriggered = $this->triggerOnHit();
        $struckPassiveAbilityTriggered = $entity->triggerWhenStruck($entity);
        $damageBlocked = $damage - $damageAfterBlocking;
        $hitSuccess = false;

        if ($tryLoseEnergy && $hitOrMiss) {
            $entity->takeDamage($damageAfterBlocking);
            $hitSuccess = true;
            $lifesteal = $this->lifesteal($damageAfterBlocking);
        }


        $hitResult = [
            'striker' => $this->getName(),
            'strikerClass' => $this->getClass(),
            'strikerSubclass' => $this->getSubclass(),
            'strikerPassiveAbility' => $strikerPassiveAbilityTriggered,
            'struck' => $entity->getName(),
            'struckClass' => $entity->getClass(),
            'struckSubclass' => $entity->getSubclass(),
            'struckHpBeforeHit' => $struckHpBeforeHit,
            'struckCurrentHp' => $entity->getHealth(),
            'struckPassiveAbility' => $struckPassiveAbilityTriggered,
            'damageDone' => $damageAfterBlocking,
            'damageBlocked' => $damageBlocked,
            'hit' => $hitOrMiss,
            'hitEnergyCost' => $hitEnergyCost,
            'enoughEnergy' => $tryLoseEnergy,
            'hitSuccess' => $hitSuccess,
            'lifesteal' => $lifesteal,
        ];

        return $hitResult;
    }

    abstract function specialAbility(): array;
    abstract function passiveAbility(): array;
}
