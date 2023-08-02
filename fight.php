<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'autoload.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.php';

use Class\HeroesManager;
use Class\FightManager;

$heroesManager = new HeroesManager($db);
$fightManager = new FightManager();

$hero = $heroesManager->find($_POST['id']);
if (isset($_POST['restore'])) {
    $restore = explode(" ", $_POST['restore']);

    switch ($restore[1]) {
        case 'hp':
            $hero->gainHealth($restore[0]);
            break;
        case 'energy':
            $hero->gainEnergy($restore[0]);
            break;
        default:
            break;
    }

    if (isset($_POST['gainStats'])) {
        switch ($_POST['gainStats']) {
            case 'agility':
                $hero->gainAgility(5);
                break;
            case 'defence':
                $hero->gainDefence(2);
                break;
            case 'lifesteal':
                $hero->gainLifesteal(4);
                break;
            default:
                break;
        }
    }
}
$foe = $fightManager->createFoe();
$combatLogs = $fightManager->fight($hero, $foe);
$heroesManager->update($hero);
$restoreHp = floor($fightManager->getFoeTotalDmg() / 1.75);
$restoreEnergy = $hero->getMaxEnergy() - $hero->getEnergy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight</title>
</head>

<body>
    <?php
    foreach ($combatLogs as $key => $actions) {
        echo "<h4> Round {$key}</h4>";
        foreach ($actions as $action){
        echo "<p> {$action} </p>";
        }
        echo "<br>";
    }
    if ($hero->getHealth() > 0) {
        echo <<<HTML
         <h2>You won!</h2>
         <p>HP : {$hero->getHealth()}/{$hero->getMaxHp()}   Energy : {$hero->getEnergy()}/{$hero->getMaxEnergy()}</p>
         <p>Defence : {$hero->getDefence()}   Agility : {$hero->getAgility()}   Lifesteal : {$hero->getLifesteal()}</p>
         <form action="" method="POST">
             <div>
                 <label for="bonus">
                     <input type="radio" name="restore" value="{$restoreHp} hp" required>
                     + {$restoreHp} HP
                 </label>
             </div>
             <div>
                 <label for="bonus">
                     <input type="radio" name="restore" value="{$restoreEnergy} energy"required>
                     + {$restoreEnergy} Energy
                 </label>
             </div>
             <div>
                 <label for="bonus">
                     <input type="radio" name="gainStats" value="agility"required>
                     +5 Agility
                 </label>
             </div>
             <div>
                 <label for="bonus">
                     <input type="radio" name="gainStats" value="defence"required>
                     +2 Defence
                 </label>
             </div>
             <div>
                 <label for="bonus">
                     <input type="radio" name="gainStats" value="lifesteal"required>
                     +4 Lifesteal
                 </label>
             </div>
             <input type="number" name="id" value="{$_POST['id']}" hidden required>
             <input type="submit" value="Next">
         </form>
        HTML;
    } else {
        echo <<<HTML
            <h2>You lost!</h2>
            <button onclick="location.href='index.php';">Play Again</button>
            <button onclick="location.href='leaderboard.php';">Leaderboard</button>
        HTML;
    }
    ?>
</body>

</html>