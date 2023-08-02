<?php

namespace Class;


abstract class Foe
{


    public function __construct(
        private string $name,
        protected int $health,
        private array $debuff = [
            'Distracted' => 0,
            'Slowed' => 0,
            'Stunned' => 0,
            'Infected' => 0,
            'Dazed' => 0,
            'Disarmed' => 0,

        ],
    ) {
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function distract(int $rounds): void
    {
        $this->debuff['Distracted'] = $rounds;
    }

    public function slow(int $rounds): void
    {
        $this->debuff['Slowed'] = $rounds;
    }

    public function stun(int $rounds): void
    {
        $this->debuff['Stunned'] = $rounds;
    }

    public function infected(int $rounds): void
    {
        $this->debuff['Infected'] = $rounds;
    }

    public function dazed(int $rounds): void
    {
        $this->debuff['Dazed'] = $rounds;
    }

    public function disarm(int $rounds): void
    {
        $this->debuff['Disarmed'] = $rounds;
    }

    public function debuffCountdown(): void
    {
        foreach ($this->debuff as $key => $value) {
            $this->debuff[$key] = max(0, --$value);
        }
    }

    abstract function hit(Hero $hero): int;
    abstract function getClass(): string;
}
