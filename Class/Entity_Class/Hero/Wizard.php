<?php

namespace Class\Entity_Class\Hero;

use Class\Entity;
use Class\Entity_Class\Hero;

abstract class Wizard extends Hero
{
    protected const ENTITY_CLASS = 'Wizard';
    protected const PASSIVE_ABILITY_NAME = 'Double Damage';
    protected const PASSIVE_ABILITY_DESCRIPTION = 'Damages are doubled';
    protected const PASSIVE_ABILITY_TRIGGER_TYPE = 'on hit';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 10;
    protected const WORST_ENEMY = 'Ghost';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1.3;

    public function passiveAbility(Entity $me, Entity $enemy, int $damage): array
    {
        $finalDamage = $enemy->takeDamage($damage);
        $summary = [
            'actionType' => 'passive ability',
            'actionName' => $me->getPassiveAbilityName(),
            'enemyName' => $enemy->getName(),
            'myName' => $me->getName(),
            'effectTarget' => $enemy->getName(),
            'meHeal' => false,
            'meDamage' => false,
            'meEnergyLoss' => false,
            'meEnergyGain' => false,
            'meEffect' => false,
            'meEffectDuration' => false,
            'enemyHeal' => false,
            'enemyDamage' => $finalDamage,
            'enemyEnergyLoss' => false,
            'enemyEnergyGain' => false,
            'enemyEffect' => false,
            'enemyEffectDuration' => false,
        ];
        return $summary;
    }
}
