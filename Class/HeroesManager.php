<?php

namespace Class;

use Class\Entity_Class\Hero\Archer;
use Class\Entity_Class\Hero\Mage;
use Class\Entity_Class\Hero\Warrior;

class HeroesManager
{


    public function __construct(
        private \PDO $db,
    ) {
        $this->db = $db;
    }

    public function add(Hero $hero): void
    {
        $insertName = $this->db->prepare(
            'INSERT INTO heroes (name, class, health_point, energy, defence, agility, lifesteal) VALUES (:name, :class, :health_point, :energy, :defence, :agility, :lifesteal)'
        );
        $insertName->execute([
            ':name' => $hero->getName(),
            ':class' => $hero->getClass(),
            ':health_point' => $hero->getMaxHp(),
            ':energy' => $hero->getMaxEnergy(),
            ':defence' => $hero->getDefence(),
            ':agility' => $hero->getAgility(),
            ':lifesteal' => $hero->getLifesteal(),
        ]);
        $id = $this->db->lastInsertId();
        $hero->setId($id);
    }

    public function findAllAlive(): array
    {
        $prepareHeroesAlive = $this->db->prepare('SELECT * FROM heroes WHERE health_point > 0');
        $prepareHeroesAlive->execute();
        $heroesAlive = $prepareHeroesAlive->fetchAll();
        return $heroesAlive;
    }

    public function findTopTen(): array
    {
        $prepareTopTen = $this->db->prepare('SELECT * FROM heroes ORDER BY lvl DESC LIMIT 10');
        $prepareTopTen->execute();
        $topTen = $prepareTopTen->fetchAll();
        return $topTen;
    }

    public function find(int $id): Hero
    {
        $prepareFindHero = $this->db->prepare('SELECT * FROM heroes WHERE id = :id');
        $prepareFindHero->execute([
            ':id' => $id,
        ]);
        $heroFound = $prepareFindHero->fetch();
        switch ($heroFound['class']) {
            case "Archer":
                $hero = new Archer($heroFound['name']);
                break;
            case "Mage":
                $hero = new Mage($heroFound['name']);
                break;
            case "Warrior":
                $hero = new Warrior($heroFound['name']);
                break;
            default:
                break;
        }

        $hero->setId($heroFound['id']);
        $hero->setHealth($heroFound['health_point']);
        $hero->setEnergy($heroFound['energy']);
        $hero->setDefence($heroFound['defence']);
        $hero->setAgility($heroFound['agility']);
        $hero->setLifesteal($heroFound['lifesteal']);
        $hero->setLvl($heroFound['lvl']);
        return $hero;
    }

    public function update(Hero $hero): void
    {

        $updateHero = $this->db->prepare(
            'UPDATE heroes SET lvl = :lvl, health_point = :health_point, energy = :energy, defence = :defence, agility = :agility, lifesteal = :lifesteal WHERE id = :id'
        );
        $updateHero->execute([
            ':id' => $hero->getId(),
            ':lvl' => $hero->getLvl(),
            ':health_point' => $hero->getHealth(),
            ':energy' => $hero->getEnergy(),
            ':defence' => $hero->getDefence(),
            ':agility' => $hero->getAgility(),
            ':lifesteal' => $hero->getLifesteal(),
        ]);
    }
}
