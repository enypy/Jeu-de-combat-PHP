<?php

namespace Class\Entity_Class\Foe;

use Class\Foe;
use Class\Hero;

class Ogre extends Foe
{
    private const FOE_CLASS = 'Ogre';

    public function getClass(): string
    {
        return self::FOE_CLASS;
    }

    public function hit(Hero $hero): int
    {
        $damage = rand(10, 200);
        $hit = rand(0, 100);
        if ($hit > 7 + ($hero->getAgility() / 10)) {
            $heroHealth = $hero->getHealth();
            if ($hero->getClass() === 'Archer') {
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
