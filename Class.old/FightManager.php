<?php

namespace Class;

use Class\Entity_Class\Foe\Infantryman;
use Class\Entity_Class\Foe\Ogre;
use Class\Entity_Class\Foe\Wizard;

class FightManager
{
    private array $combatLogs = [];
    private int $foeTotalDmg = 0;
    private int $heroTotalDmg = 0;

    private function setFoeTotalDmg(int $foeTotalDmg): void
    {
        $this->foeTotalDmg = $foeTotalDmg;
    }

    public function getFoeTotalDmg(): int
    {
        return $this->foeTotalDmg;
    }

    private function setHeroTotalDmg(int $heroTotalDmg): void
    {
        $this->heroTotalDmg = $heroTotalDmg;
    }

    public function getHeroTotalDmg(): int
    {
        return $this->heroTotalDmg;
    }

    public function createFoe(): Foe
    {
        $pickFoeType = rand(1, 3);
        switch ($pickFoeType) {
            case 1:
                $foe = new Infantryman("name", rand(500, 700));
                break;
            case 2:
                $foe = new Ogre("name", rand(700, 1100));
                break;
            case 3:
                $foe = new Wizard("name", rand(400, 600));
                break;
            default:
                break;
        }

        return $foe;
    }

    public function fight(Hero $hero, Foe $foe): array
    {
        $round = 0;

        while ($hero->getHealth() > 0 && $foe->getHealth() > 0) {
            $round++;
            $foeDmg = $foe->hit($hero);
            $foe->debuffCountdown();
            if ($foeDmg > 0) {
                $this->setCombatLogs($round, "{$foe->getClass()} hits {$hero->getName()} ({$hero->getClass()}): -{$foeDmg}");
                $this->setFoeTotalDmg($this->getFoeTotalDmg() + $foeDmg);
            } else {
                $this->setCombatLogs($round, "{$foe->getClass()} hits {$hero->getName()} ({$hero->getClass()}): Miss!");
            }
            if ($hero->getHealth() > 0) {
                $energyRestored = rand(0, 10);
                $hero->gainEnergy($energyRestored);
                $this->setCombatLogs($round, "{$hero->getName()} ({$hero->getClass()}) +{$energyRestored} energy");
                if ($hero->getEnergy() >= $hero->getSpecialAbilityCost()) {
                    $heroDmg = $hero->specialAbility($foe);
                    $this->setCombatLogs($round, "{$hero->getName()} ({$hero->getClass()}) uses {$hero->getSpecialAbilityName()} on {$foe->getClass()}: -{$heroDmg}");
                    if ($hero->getLifesteal() > 0) {
                        $lifestealHeal = ceil($heroDmg * ($hero->getLifesteal() / 10) / 100);
                        $hero->setHealth($hero->getHealth() + $lifestealHeal);
                        $this->setCombatLogs($round, "{$hero->getName()} ({$hero->getClass()}) lifesteal : + {$lifestealHeal} HP");
                    }
                    $this->setHeroTotalDmg($this->getHeroTotalDmg() + $heroDmg);
                } elseif ($hero->getEnergy() >= 5) {
                    $heroDmg = $hero->hit($foe);
                    $this->setCombatLogs($round, "{$hero->getName()} ({$hero->getClass()}) hits {$foe->getClass()}: -{$heroDmg}");
                    if ($hero->getLifesteal() > 0) {
                        $lifestealHeal = ceil($heroDmg * ($hero->getLifesteal() / 10) / 100);
                        $hero->setHealth($hero->getHealth() + $lifestealHeal);
                        $this->setCombatLogs($round, "{$hero->getName()} ({$hero->getClass()}) lifesteal : + {$lifestealHeal} HP");
                    }
                    $this->setHeroTotalDmg($this->getHeroTotalDmg() + $heroDmg);
                } else {
                    $this->setCombatLogs($round, "{$hero->getName()} ({$hero->getClass()}) not enough energy");
                }
            }
        }

        if ($hero->getHealth() > 0) {
            $hero->gainLvl();
        }

        return $this->getCombatLogs();
    }

    private function setCombatLogs(int $round, string $log): void
    {
        $this->combatLogs[$round][] = $log;
    }

    public function getCombatLogs(): array
    {
        return $this->combatLogs;
    }
}
