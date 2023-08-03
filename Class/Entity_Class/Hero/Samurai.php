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
    protected const PASSIVE_ABILITY_TRIGGER_CHANCE = 150;
    protected const WORST_ENEMY = 'Orc';
    protected const WORST_ENEMY_DAMAGE_MULTIPLIER = 1.5;

    function specialAbility(Entity $this, Entity $enemy): array
    {
        $enemy->setEffect('stun', 1);
        return;
    }
}