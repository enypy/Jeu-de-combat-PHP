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
            'enemyDamage' => false,
            'enemyEnergyLoss' => false,
            'enemyEnergyGain' => false,
            'enemyEffect' => $effect,
            'enemyEffectDuration' => 1,
        ];
        return $summary;
    }
}
