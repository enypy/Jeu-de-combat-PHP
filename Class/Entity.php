<?php

namespace Class;

use Class\Entity as ClassEntity;

abstract class Entity
{

    protected int $id;
    protected int $health;
    protected int $energy;
    protected int $hitChance;
    protected int $damage;
    protected int $defence;
    protected int $agility;
    protected int $lifesteal;
    protected const ENTITY_CLASS = '';
    protected const ENTITY_SUBCLASS = '';
    protected const ENTITY_TYPE = '';
    protected const MAX_HP = 0;
    protected const MAX_ENERGY = 0;
    protected const DAMAGE_TYPE = 'physical';
    protected const HIT_MAX_DMG = 0;
    protected const HIT_MIN_DMG = 0;
    protected const SPECIAL_ABILITY_NAME = '';
    protected const SPECIAL_ABILITY_COST = 0;
    protected const PASSIVE_ABILITY_NAME = '';
    protected const PASSIVE_ABILITY_DESCRIPTION = '';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 0;




    protected array $state = [
        'distracted' => 0,
        'slowed' => 0,
        'stunned' => 0,
        'infected' => 0,
        'dazed' => 0,
        'disarmed' => 0,

    ];


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

    public function getDamageType(): string
    {
        return $this::DAMAGE_TYPE;
    }

    public function setState(string $stateName, int $rounds): void
    {
        $this->state[$stateName] = $rounds;
    }


    public function stateCountdown(): void
    {
        foreach ($this->state as $key => $value) {
            $this->state[$key] = max(0, --$value);
        }
    }

    public function hitOrMiss(Entity $entity): bool
    {
        $damageType = $this->getDamageType();
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

    public function blockDamage(int $incomingDamage): int
    {
        $damageType = $this->getDamageType();
        if ($damageType !== 'magical') {
            $defence = $this->getDefence();
            $damageReductionPercent = $defence / 10;
            $damage = floor($incomingDamage - ($incomingDamage * ($damageReductionPercent / 100)));
            return $damage;
        } else {
            return $incomingDamage;
        }
    }

    public function triggerOnHit(): bool
    {
        $triggerChance = $this->getPassiveAbilityTriggerChance();
        $rand = rand(0, 100);

        if ($rand > $triggerChance) {
            return false;
        } else {
            return true;
        }
    }

    public function hit(Entity $entity): array
    {
        $maxDamage = $this->getHitMaxDamage();
        $minDamage = $this->getHitMinDamage();
        $damage = rand($minDamage, $maxDamage);
    }

    abstract function specialAbility(): array;
    abstract function passiveAbility(): array;
}
