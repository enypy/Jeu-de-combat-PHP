<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'autoload.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.php';

use Class\HeroesManager;

$heroesManager = new HeroesManager($db);
$topTen = $heroesManager->findTopTen();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
</head>
<body>
<button onclick="location.href='index.php';">Index</button>
    <?php
    $ranking = 0;
    foreach ($topTen as $hero) {
        ++$ranking;
     echo<<<HTML
     <div>
        <h4>{$ranking}. {$hero['name']} LVL: {$hero['lvl']}</h4>
        <p>Class: {$hero['class']} Defence: {$hero['defence']} Agility: {$hero['agility']} Lifesteal: {$hero['lifesteal']}<p>
    </div>
    HTML;
    }
    ?>
</body>
</html>