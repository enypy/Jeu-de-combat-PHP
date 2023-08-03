<?php

namespace Class\Entity_Class\Hero;

use Class\Entity;
use Class\Entity_Class\Hero;

abstract class Yokai extends Hero
{
    protected const ENTITY_CLASS = 'Yokai';
    protected const PASSIVE_ABILITY_NAME = 'Damage Absorption';
    protected const PASSIVE_ABILITY_DESCRIPTION = 'Incoming damages are transformed into healing';
    protected const PASSIVE_ABILITY_TRIGGER_TYPE = 'when struck';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 12;
    protected const WORST_ENEMY = 'Skeleton';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1.75;

    public function passiveAbility(Entity $me, Entity $enemy, int $damage): array
    {
        $me->heal($damage);
        $healed = $me->heal($damage);
        $summary = [
            'actionType' => 'passive ability',
            'enemyName' => $enemy->getName(),
            'myName' => $me->getName(),
            'effectTarget' => $me->getName(),
            'abilityName' => $me->getPassiveAbilityName(),
            'meHeal' => $healed,
            'meDamage' => 0,
            'meEnergyLoss'=> 0,
            'meEnergyGain'=> 0,
            'meEffect' => 0,
            'enemyHeal' => 0,
            'enemyDamage' => 0,
            'enemyEnergyLoss'=> 0,
            'enemyEnergyGain'=> 0,
            'enemyEffect' => 0,
        ];
        return $summary;
    }
}