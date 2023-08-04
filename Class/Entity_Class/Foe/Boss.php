<?php

namespace Class\Entity_Class\Foe;

use Class\Entity;
use Class\Entity_Class\Foe;

abstract class Boss extends Foe
{
    protected const ENTITY_CLASS = 'Boss';
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
            'actionName' => $me->getPassiveAbilityName(),
            'enemyName' => $enemy->getName(),
            'myName' => $me->getName(),
            'effectTarget' => $me->getName(),
            'meHeal' => $healed,
            'meDamage' => false,
            'meEnergyLoss' => false,
            'meEnergyGain' => false,
            'meEffect' => false,
            'enemyHeal' => false,
            'enemyDamage' => false,
            'enemyEnergyLoss' => false,
            'enemyEnergyGain' => false,
            'enemyEffect' => false,
        ];
        return $summary;
    }
}
