<?php
try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=jeu_de_combat", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../index.php?err=DBconnection');
    exit();
}
