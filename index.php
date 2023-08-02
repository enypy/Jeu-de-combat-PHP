<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'autoload.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.php';

use Class\Entity_Class\Hero\Archer;
use Class\Entity_Class\Hero\Mage;
use Class\Entity_Class\Hero\Warrior;
use Class\HeroesManager;
use Class\Hero;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOW 2</title>
</head>

<body>
<button onclick="location.href='leaderboard.php';">Leaderboard</button>

    <?php
    $heroesManager = new HeroesManager($db);
    if (isset($_POST['name']) && isset($_POST['class'])) {
        switch ($_POST['class']) {
            case "Archer":
                $heroesManager->add(new Archer($_POST['name']));
                break;
            case "Mage":
                $heroesManager->add(new Mage($_POST['name']));
                break;
            case "Warrior":
                $heroesManager->add(new Warrior($_POST['name']));
                break;
            default:
                break;
        }
    }

    if (!isset($_POST['name'])) {
        echo <<<HTML
            <form action="" method="POST">
                <label for="name">Input your name:</label>
                <input type="text" name="name" placeholder="Name" required>
                <label for="class">Choose your class:</label>
                <select name="class" required>
                    <option value="Archer">Archer</option>
                    <option value="Mage">Mage</option>
                    <option value="Warrior">Warrior</option>
                </select>
                <input type="submit" value="Play!">
            </form>
        HTML;
    }

    foreach ($heroesManager->findAllAlive() as $hero) {
        echo <<<HTML
            <form action="fight.php" method="POST">
                <div>
                    <p>Name: {$hero['name']} ({$hero['class']}) </p>
                </div>
                <div>
                    <p>Health: {$hero['health_point']}</p> 
                </div>
                <input type="number" name="id" value="{$hero['id']}" hidden>
                <input type="submit" value="select">
            </form>
        HTML;
    }

    ?>

</body>

</html>