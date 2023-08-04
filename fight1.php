<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'autoload.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.php';

use Class\Entity_Class\Foe\Ghost\Gotoku;
use Class\Entity_Class\Foe\Ghost\Yurei;
use Class\Entity_Class\Hero\Yokai\Karasu;
use Class\Entity_Class\Hero\Yokai\Kitsune;
use Class\Entity_Class\Hero\Yokai\Yamabushi;

$hero = new Yamabushi('bruh');
$foe = new Gotoku('Ghost');

$combatLogs = $hero->hit($foe);
$combatLogs1 = $foe->hit($hero);

$combatLogs2 = $hero->specialAbility($foe);
$combatLogs3 = $foe->specialAbility($hero);


echo "<pre>";
print_r($combatLogs);
echo "</pre>";
echo "<pre>";
print_r($combatLogs1);
echo "</pre>";
echo "<pre>";
print_r($combatLogs2);
echo "</pre>";
echo "<pre>";
print_r($combatLogs3);
echo "</pre>";