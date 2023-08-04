<?php

namespace Class\Entity_Class\Hero;

use Class\Entity;
use Class\Entity_Class\Hero;

abstract class Ninja extends Hero
{
    protected const ENTITY_CLASS = 'Ninja';
    protected const PASSIVE_ABILITY_NAME = 'Energysteal';
    protected const PASSIVE_ABILITY_DESCRIPTION = 'Steal 3-10 from enemy';
    protected const PASSIVE_ABILITY_TRIGGER_TYPE = 'on hit';
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 100;
    protected const WORST_ENEMY = 'Boss';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1.25;

    public function passiveAbility(Entity $me, Entity $enemy, int $damage): array
    {
        $energy = rand(3, 10);
        $enemyEnergyLoss = $enemy->tryLoseEnergy($energy);
        if ($enemyEnergyLoss) {
            $meEnergyGain = $me->gainEnergy($enemyEnergyLoss);
        } else {
            $enemyEnergyLoss = 0;
            $meEnergyGain = 0;
        }

        $summary = [
            'actionType' => 'passive ability',
            'actionName' => $me->getPassiveAbilityName(),
            'enemyName' => $enemy->getName(),
            'myName' => $me->getName(),
            'effectTarget' => $enemy->getName(),
            'meHeal' => false,
            'meDamage' => false,
            'meEnergyLoss' => false,
            'meEnergyGain' => $meEnergyGain,
            'meEffect' => false,
            'enemyHeal' => false,
            'enemyDamage' => false,
            'enemyEnergyLoss' => $enemyEnergyLoss,
            'enemyEnergyGain' => false,
            'enemyEffect' => false,
        ];
        return $summary;
    }
}
