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
            'enemyName' => $enemy->getName(),
            'myName' => $me->getName(),
            'effectTarget' => $enemy->getName(),
            'abilityName' => $me->getPassiveAbilityName(),
            'meHeal' => 0,
            'meDamage' => 0,
            'meEnergyLoss' => 0,
            'meEnergyGain' => $meEnergyGain,
            'meEffect' => 0,
            'enemyHeal' => 0,
            'enemyDamage' => 0,
            'enemyEnergyLoss' => $enemyEnergyLoss,
            'enemyEnergyGain' => 0,
            'enemyEffect' => 0,
        ];
        return $summary;
    }
}
