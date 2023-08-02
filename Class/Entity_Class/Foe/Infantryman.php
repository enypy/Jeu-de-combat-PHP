<?php

namespace Class\Entity_Class\Foe;

use Class\Foe;
use Class\Hero;

class Infantryman extends Foe
{
    private const FOE_CLASS = 'Infantryman';

    public function getClass(): string
    {
        return self::FOE_CLASS;
    }

    public function hit(Hero $hero): int
    {
        $damage = rand(10, 300);
        $hit = rand(0, 100);
        if ($hit > 15 + ($hero->getAgility() / 10)) {
            $heroHealth = $hero->getHealth();
            if ($hero->getClass() === 'Mage') {
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
