<?php

namespace Class\Entity_Class;

use Class\Entity;

abstract class Hero extends Entity
{
    protected const ENTITY_TYPE = 'Hero';
    protected int $lvl = 0;
    protected int $maxLvl = 0;
    protected int $xp = 0;
    protected int $stage = 0;


    //////////////// LVL /////////////////////
    public function setLvl(int $lvl): void
    {
        $this->lvl = max(0, $lvl);
    }

    public function getLvl(): int
    {
        return $this->lvl;
    }
    ////////////////////////////////////////


    //////////////// XP /////////////////////
    public function setXp(int $xp): void
    {
        $this->xp = max(0, $xp);
    }

    public function getXp(): int
    {
        return $this->xp;
    }

    public function gainXp(Entity $entity, int $damageReceived): int
    {
        $xpCalc = ceil($entity->getMaxHp() / 10 + $entity->getEnergy() / 5 + $damageReceived / 9);
        $this->xp += $xpCalc;
        return $xpCalc;
    }
    ////////////////////////////////////////


    ////////////////STAGE/////////////////////
    public function setStage(int $stage): void
    {
        $this->stage = max(0, $stage);
    }

    public function getStage(): int
    {
        return $this->stage;
    }

    public function nextStage(): void
    {
        $this->stage++;
    }
    ///////////////////////////////////////
}
