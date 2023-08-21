<?php

namespace Class;


abstract class Entity
{

    protected int $id;
    protected int $health;
    protected int $maxHealth;
    protected int $energy;
    protected const MAX_ENERGY = 0;
    protected int $hitChance;
    protected int $maxHitChance;
    protected int $attack;
    protected int $maxAttack;
    protected int $defence;
    protected int $maxDefence;
    protected int $agility;
    protected int $maxAgility;
    protected int $lifesteal;
    protected int $maxLifesteal;
    protected const ENTITY_CLASS = '';
    protected const ENTITY_SUBCLASS = '';
    protected const ENTITY_TYPE = '';
    protected const HIT_DAMAGE_TYPE = '';
    protected const HIT_DISTANCE = '';
    protected const HIT_MAX_DMG = 0;
    protected const HIT_MIN_DMG = 0;
    protected const HIT_COST = 0;
    protected const SPECIAL_ABILITY_NAME = '';
    protected const SPECIAL_ABILITY_DESCRIPTION = '';
    protected const SPECIAL_ABILITY_COST = 0;
    protected const PASSIVE_ABILITY_NAME = '';
    protected const PASSIVE_ABILITY_DESCRIPTION = '';
    protected const PASSIVE_ABILITY_TRIGGER_TYPE = '';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 0;
    protected const WORST_ENEMY = '';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1;
    protected array $effect = [
        'stunned' => 0,
        'bleeding' => 0,
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

    //////////////// HEALTH /////////////////////
    public function setHealth(int $health): void
    {
        $this->health = max(0, $health);
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setMaxHp(int $hp): void
    {
        $this->maxHealth = $hp;
    }

    public function getMaxHp(): int
    {
        return $this->maxHealth;
    }

    public function heal(int $health): int
    {
        $healthBeforeGain = $this->health;
        $health = $healthBeforeGain + $health;
        $this->health = min($this->getMaxHp(), $health);
        $currentHealth = $this->getHealth();
        $healthGained = $currentHealth - $healthBeforeGain;
        return $healthGained;
    }

    public function takeDamage(int $damage): int
    {
        $healthBeforeDamage = $this->health;
        $healthAfterDamage = $healthBeforeDamage - $damage;
        $this->health = max(0, $healthAfterDamage);
        $currentHealth = $this->getHealth();
        $healthLost = $healthBeforeDamage - $currentHealth;
        return $healthLost;
    }
    //////////////////////////////////////////////


    //////////////// ENERGY /////////////////////
    public function setEnergy(int $energy): void
    {
        $this->energy = max(0, $energy);
        $currentEnergy = $this->getEnergy();
        $maxEnergy = $this->getMaxEnergy();
        $this->energy = min($currentEnergy, $maxEnergy);
    }

    public function getEnergy(): int
    {
        return $this->energy;
    }

    public function getMaxEnergy(): int
    {
        return $this::MAX_ENERGY;
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

    public function regenEnergy(): int
    {
        $rand = rand(1, 10);
        $energyGained = $this->gainEnergy($rand);
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
    //////////////////////////////////////////////////


    //////////////// HIT CHANCE /////////////////////
    public function setHitChance(int $hitChance): void
    {
        $this->hitChance = max(0, $hitChance);
    }

    public function getHitChance(): int
    {
        return $this->hitChance;
    }

    public function gainHitChance(int $hitChance): void
    {
        $this->hitChance += $hitChance;
    }

    public function loseHitChance(int $hitChance): void
    {
        $hitChance = $this->hitChance -= $hitChance;
        $this->hitChance = max(0, $hitChance);
    }

    public function getMaxHitChance(): int
    {
        return $this->maxHitChance;
    }

    public function setMaxHitChance(int $hitChance = 0): void
    {
        $this->maxHitChance = $this->maxHitChance + $hitChance;
        $this->hitChance = $this->maxHitChance;
    }

    public function gainMaxHitChance(int $hitChance): void
    {
        $this->maxHitChance += $hitChance;
        $this->hitChance = $this->maxHitChance;
    }
    //////////////////////////////////////////////


    //////////////// ATTACK /////////////////////
    public function setAttack(int $attack): void
    {
        $this->attack = max(0, $attack);
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function gainAttack(int $attack): void
    {
        $this->attack += $attack;
    }

    public function loseAttack(int $attack): void
    {
        $attack = $this->attack -= $attack;
        $this->attack = max(0, $attack);
    }

    public function getMaxAttack(): int
    {
        return $this->maxAttack;
    }

    public function setMaxAttack(int $attack = 0): void
    {
        $this->maxAttack = $this->maxAttack + $attack;
        $this->attack = $this->maxAttack;
    }

    public function gainMaxAttack(int $attack): void
    {
        $this->maxAttack += $attack;
        $this->attack = $this->maxAttack;
    }
    //////////////////////////////////////////////


    //////////////// DEFENCE /////////////////////
    public function setDefence(int $defence): void
    {
        $this->defence = max(0, $defence);
    }

    public function getDefence(): int
    {
        return $this->defence;
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

    public function getMaxDefence(): int
    {
        return $this->maxDefence;
    }

    public function setMaxDefence(int $defence = 0): void
    {
        $this->maxDefence = $this->maxDefence + $defence;
        $this->defence = $this->maxDefence;
    }

    public function gainMaxDefence(int $defence): void
    {
        $this->maxDefence += $defence;
        $this->defence = $this->maxDefence;
    }
    //////////////////////////////////////////////


    //////////////// AGILITY /////////////////////
    public function setAgility(int $agility): void
    {
        $this->agility = max(0, $agility);
    }

    public function getAgility(): int
    {
        return $this->agility;
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

    public function getMaxAgility(): int
    {
        return $this->maxAgility;
    }

    public function setMaxAgility(int $agility = 0): void
    {
        $this->maxAgility = $this->maxAgility + $agility;
        $this->agility = $this->maxAgility;
    }

    public function gainMaxAgility(int $agility): void
    {
        $this->maxAgility += $agility;
        $this->agility = $this->maxAgility;
    }
    //////////////////////////////////////////////


    //////////////// LIFESTEAL /////////////////////
    public function setLifesteal(int $lifesteal): void
    {
        $this->lifesteal = max(0, $lifesteal);
    }

    public function getLifesteal(): int
    {
        return $this->lifesteal;
    }

    public function gainLifesteal(int $lifesteal): void
    {
        $this->lifesteal += $lifesteal;
    }

    public function loseLifesteal(int $lifesteal): void
    {
        $lifesteal = $this->lifesteal -= $lifesteal;
        $this->lifesteal = max(0, $lifesteal);
    }

    public function getMaxLifesteal(): int
    {
        return $this->maxLifesteal;
    }

    public function setMaxLifesteal(int $lifesteal = 0): void
    {
        $this->maxLifesteal = $this->maxLifesteal + $lifesteal;
        $this->lifesteal = $this->maxLifesteal;
    }

    public function gainMaxLifesteal(int $lifesteal): void
    {
        $this->maxLifesteal += $lifesteal;
        $this->lifesteal = $this->maxLifesteal;
    }

    protected function lifesteal(int $damage): int
    {
        $lifeSteal = $this->getLifesteal();
        $heal = ceil($damage * (($lifeSteal / 10) / 100));
        $healed = $this->heal($heal);

        return  $healed;
    }
    //////////////////////////////////////////////


    public function getSpecialAbilityName(): string
    {
        return $this::SPECIAL_ABILITY_NAME;
    }

    public function getSpecialAbilityDescription(): string
    {
        return $this::SPECIAL_ABILITY_DESCRIPTION;
    }

    public function getSpecialAbilityCost(): int
    {
        return $this::SPECIAL_ABILITY_COST;
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

    public function effectCountdown(): array
    {
        $activeEffects = [];
        foreach ($this->effect as $key => $value) {
            if ($key > 0) {
                $activeEffects[$value] = $key;
                switch ($value) {
                    case 'Bleeding':
                        $this->takeDamage(150);
                        $activeEffects['BleedingLogs'] = [];
                        break;

                    default:
                        break;
                }
            }
            $this->effect[$key] = max(0, --$value);
        }
        return $activeEffects;
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
            return $rand > $totalDodgeChance;
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

    protected function triggerOnHit(Entity $entity, int $damage): mixed
    {
        $triggerType = $this->getPassiveAbilityTriggerType();
        if ($triggerType === 'on hit') {
            $triggerChance = $this->getPassiveAbilityTriggerChance();
            $rand = rand(0, 100);

            if ($rand > $triggerChance) {
                return false;
            } else {
                $passiveAbility = $this->passiveAbility($this, $entity, $damage);
                return $passiveAbility;
            }
        } else {
            return false;
        }
    }

    protected function triggerWhenStruck(Entity $entity, int $damage): mixed
    {
        $triggerType = $entity->getPassiveAbilityTriggerType();
        if ($triggerType === 'when struck') {
            $triggerChance = $this->getPassiveAbilityTriggerChance();
            $rand = rand(0, 100);

            if ($rand > $triggerChance) {
                return false;
            } else {
                $passiveAbility = $entity->passiveAbility($entity, $this, $damage);
                return $passiveAbility;
            }
        } else {
            return false;
        }
    }

    protected function calculateDamage(Entity $entity, int $minDamage, int $maxDamage): int
    {
        $worstEnemy = $this->getWorstEnemy();
        $enemyClass = $entity->getClass();
        $damageBeforeAttack = rand($minDamage, $maxDamage);
        $attackBonus = $this->getAttack() / 10;
        $damage = ceil($damageBeforeAttack + ($damageBeforeAttack * ($attackBonus / 100)));

        if ($worstEnemy === $enemyClass) {
            $damageMultiplier = $this->getWorstEnemyDamageMultiplier();
            $damage = ceil($damage * $damageMultiplier);
        }

        return $damage;
    }

    public function hit(Entity $entity): array
    {
        $struckHpBeforeHit = $entity->getHealth();
        $strikerHpBeforeHit = $this->getHealth();
        $strikerEnergyBeforeHit = $this->getEnergy();
        $struckEnergyBeforeHit = $entity->getEnergy();
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
            'struckEnergyBeforeHit' => $struckEnergyBeforeHit,
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

    abstract function specialAbility(Entity $enemy): array;
    abstract function passiveAbility(Entity $me, Entity $enemy, int $damage): array;
}
