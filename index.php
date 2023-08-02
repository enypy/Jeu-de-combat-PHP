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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
    ?>
    <div class="card-group">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>


        <?php
        foreach ($heroesManager->findAllAlive() as $hero) {
            echo <<<HTML
            <div class="card">
            <div class="card-header"><h5 class="card-title">{$hero['name']} <small>({$hero['class']})</small></h5></div>
            <img src="..." class="card-img-top" alt="...">

            <div class="card-body">
            <h5 class="card-title">{$hero['name']} ({$hero['class']})</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            <form action="fight.php" method="POST" class="text-center">
            <input type="number" name="id" value="{$hero['id']}" hidden>
                <input type="submit" class="btn btn-primary" value="SELECT">
                </form>
            </div>
            </div>
            <form action="fight.php" method="POST" class="text-center">
                <div>
                    <p>Name: {$hero['name']} ({$hero['class']}) </p>
                </div>
                <div>
                    <p>Health: {$hero['health_point']}</p> 
                </div>
                <input type="number" name="id" value="{$hero['id']}" hidden>
                <input type="submit" class="btn btn-primary" value="select">
            </form>
        HTML;
        }

        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>