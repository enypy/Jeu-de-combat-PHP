<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'autoload.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.php';

use Class\Entity_Class\Foe\Ghost\Gotoku;
use Class\Entity_Class\Foe\Ghost\Yurei;
use Class\Entity_Class\Hero\Yokai\Karasu;
use Class\Entity_Class\Hero\Yokai\Kitsune;
use Class\Entity_Class\Hero\Yokai\Yamabushi;

$hero = new Yamabushi('Yamabushi');
$foe = new Gotoku('Gotoku');


while ($hero->getHealth() > 0 && $foe->getHealth() > 0) {
    if ($hero->getSpecialAbilityCost() <= $hero->getEnergy()) {
        $combatLogs = $hero->specialAbility($foe);
    } else {
        $combatLogs = $hero->hit($foe);
    }
    echo "<pre>";
    print_r($combatLogs);
    echo "</pre>";
    if ($foe->getSpecialAbilityCost() <= $foe->getEnergy()) {
        $combatLogs = $foe->specialAbility($hero);
    } else {
        $combatLogs = $foe->hit($hero);
    }
    echo "<pre>";
    print_r($combatLogs);
    echo "</pre>";
}

if ($hero->getHealth() < 0) {
    echo "<br>";
    echo "YOU LOST!";
} else {
    echo "<br>";
    echo "YOU WON!";
}
