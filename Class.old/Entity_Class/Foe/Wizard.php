<?php

namespace Class\Entity_Class\Foe;

use Class\Foe;
use Class\Hero;

class Wizard extends Foe
{
    private const FOE_CLASS = 'Wizard';

    public function getClass(): string
    {
        return self::FOE_CLASS;
    }

    public function hit(Hero $hero): int
    {
        $damage = rand(10, 230);
        $hit = rand(0, 100);
        if ($hit > 2 + ($hero->getAgility() / 10)) {
            $heroHealth = $hero->getHealth();
            if ($hero->getClass() === 'Warrior') {
                $damage *= 2;
            }
            $damage = $damage - floor($damage*($hero->getDefence()/10)/100);
            $hero->setHealth(max(0, ($heroHealth - $damage)));
            return $damage;
        } else {
            return 0;
        }
    }
}
