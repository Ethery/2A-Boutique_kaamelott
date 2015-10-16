<?php
session_start();
include "header.html";
include "db_id.php";

$pdo = new PDO($dsn,$user,$pass);
$query = "SELECT nom,description,prix_min,ID_vendeur,chemin_photo,prix_enchereur from objet where nom=\"".$_POST["obj"]."\"";

$result = $pdo->query($query);

while ($row = $result->fetch(PDO::FETCH_LAZY))
{
    echo "<div id=\"objet\">";
    echo "<img id=\"img_objet\" width=200 heigth=300 src=photos/".$row["chemin_photo"].">";
    echo "<p id=\"nom_objet\">".ucfirst($row["nom"])."</p>";
    echo "<p id=\"desc_objet\">Description : ".$row["description"]."</p>";
    if($row["prix_enchereur"] > $row["prix_min"])
    {
        echo "<p id=\"prix_objet\">Prix de base : ".$row["prix_min"]."€</p>";
        echo "<p id=\"prix_actuel\">Prix actuel : ".$row["prix_enchereur"]."€</p>";
        $_SESSION["Prix"]=$row["prix_enchereur"];
    }
    else
    {
        echo "<p id=\"prix_objet\">Prix de base : ".$row["prix_min"]."€</p>";
        echo "<p id=\"prix_objet\">(Aucune enchere n'a encore étè faite :) ENJOY</p>";
        $_SESSION["Prix"]=$row["prix_min"];
    }

    $pdo2 = new PDO($dsn,$user,$pass);
    $query2 = "SELECT nom,prenom from utilisateur where ID=".$row["ID_vendeur"];
    $result2 = $pdo2->query($query2);
    while($row2 = $result2->fetch(PDO::FETCH_LAZY))
    {
        echo "<p id=\"vendeur_objet\">Vendeur : " . $row2[0] ." ". $row2[1] . "</p>";
    }
    echo "</div> <br>";
}
$query = "SELECT ID from utilisateur where nom=\"".$_SESSION["nom"]."\" AND prenom=\"".$_SESSION["prenom"]."\"";
$result = $pdo->query($query);
$row=$result->fetch(PDO::FETCH_LAZY);
?>



    <form action="set_enchere.php" method="post" id="encherir">
        <p>Nouveau montant pour l'objet :</p>
        <input type="number" name="montant" id="montant" min="<?php echo $_SESSION["Prix"]; ?>">
        <input type="hidden" name="user" value="<?php echo $row["ID"]; ?>">
        <input type="hidden" name="objet" value="<?php echo $_POST["obj"]; ?>">
        <input type="submit" id="submit" value="Encherir !">
    </form>

<?php
include "info.php";
include "footer.html";
?>