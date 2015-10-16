<?php
include "db_id.php";
include "header.html";

$conn = new PDO($dsn, $user, $pass);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $sql = "UPDATE objet SET ID_enchereur_actuel =" . $_POST["user"] . " WHERE nom =\"" . $_POST["objet"]."\"";
// use exec() because no results are returned
    $conn->exec($sql);
}catch (PDOExeption $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

try {
    $sql = "UPDATE objet SET prix_enchereur =" . $_POST["montant"] . " WHERE nom =\"" . $_POST["objet"]."\"";
// use exec() because no results are returned
    $conn->exec($sql);
}catch (PDOExeption $e)
{
    echo $sql . "<br>" . $e->getMessage();
}


header('Location: index.php');
?>


/*UPDATE objet SET ID_enchereur_actuel = $_POST["user"] WHERE ID = $_POST["objet"];
*/