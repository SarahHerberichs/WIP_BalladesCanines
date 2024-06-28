<?php
    // Connexion à la BDD

    $dsn = "mysql:dbname=$dbName;host=$dbHost";

    try {
        $connexion = new PDO($dsn, $dbUser, $dbPassword);
    }
    catch(PDOException $exception) {
        $message = $exception->getMessage();
        echo "Erreur de connexion à la BDD : $message";
        error_log("Échec de la connexion à la base de données : $message\n");
        exit();
    }
?>
