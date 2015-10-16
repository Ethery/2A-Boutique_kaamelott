<?php
session_start();
include "header.html";
if(empty($_POST["prenom"]) OR empty($_POST["nom"]) OR empty($_POST["adresse"]) OR empty($_POST["tel"]))
    header('Location: identification.php');

print_r($_POST);

$_SESSION["prenom"] = $_POST["prenom"];
$_SESSION["nom"] = $_POST["nom"];
$_SESSION["adresse"] = $_POST["adresse"];
$_SESSION["tel"] = $_POST["tel"];

try{
    include "db_id.php";
    $same=0;
    $pdo = new PDO($dsn,$user,$pass);
    $query = "SELECT * from utilisateur";
    $result = $pdo->query($query);
    while ($row = $result->fetch(PDO::FETCH_LAZY))
    {
        /*echo $row["nom"].$_POST["nom"]."<br>";
        echo $row["prenom"].$_POST["prenom"]."<br>"."<br>";*/
        if($row["nom"]==$_POST["nom"] AND $row["prenom"]==$_POST["prenom"])
        {
            $same=1;
            break;
        }
    }

    if($same == 0)
    {
        try {
            $conn = new PDO($dsn, $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO utilisateur (nom,prenom,adresse,telephone) VALUES ('" . $_POST["nom"] . "','" . $_POST["prenom"] . "','" . $_POST["adresse"] . "','" . $_POST["tel"] . "')";
            $conn->exec($sql);
            echo "NEW RECORD CREATED";
        }
        catch(PDOExeption $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

}catch (PDROEception $e)
{
    die("Erreur : ".$e->getMessage());
}
$conn = null;
header('Location: '.$_SESSION["dir"]);


include "info.php";
?>
