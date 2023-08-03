<?php

namespace Class\Entity_Class\Hero;

use Class\Entity;
use Class\Entity_Class\Hero;

abstract class Samurai extends Hero
{
    protected const ENTITY_CLASS = 'Samurai';
    protected const PASSIVE_ABILITY_NAME = 'Stunning Blow';
    protected const PASSIVE_ABILITY_DESCRIPTION = 'Enemy stun for one round';
    protected const PASSIVE_ABILITY_TRIGGER_TYPE = 'on hit';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 15;
    protected const WORST_ENEMY = 'Orc';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1.5;

    public function passiveAbility(Entity $me, Entity $enemy, int $damage): array
    {
        $effect = 'stun';
        $enemy->setEffect($effect, 1);
        $summary = [
            'actionType' => 'passive ability',
            'enemyName' => $enemy->getName(),
            'myName' => $me->getName(),
            'effectTarget' => $enemy->getName(),
            'abilityName' => $me->getPassiveAbilityName(),
            'meHeal' => 0,
            'meDamage' => 0,
            'meEnergyLoss'=> 0,
            'meEnergyGain'=> 0,
            'meEffect' => 0,
            'enemyHeal' => 0,
            'enemyDamage' => 0,
            'enemyEnergyLoss'=> 0,
            'enemyEnergyGain'=> 0,
            'enemyEffect' => $effect,
        ];
        return $summary;
    }
}
