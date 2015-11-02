<?php
session_start();
include "header.html";
include "db_id.php";

$pdo = new PDO($dsn,$user,$pass);
$query = "SELECT nom,description,prix_min,ID_vendeur,chemin_photo,prix_enchereur from objet where nom=\"".$_POST["obj"]."\"";

$result = $pdo->query($query);

while ($row = $result->fetch(PDO::FETCH_LAZY))
{
    echo "<br>";
    echo "<table id=\"objet\">";
    echo "<tr><td rowspan='4'><img id=\"img_objet\" src=\"photos/".$row["chemin_photo"]."\"></td></tr>";
    echo "<tr><td><h1  id=\"nom_objet\">" . ucfirst($row["nom"]) . "</h1></td></tr>";
    echo "<tr><td id=\"desc\">Description :</td></tr>";
    echo "<tr><td><p id=\"desc_objet\">". $row["description"] . "</p></td></tr>";

    $pdo2 = new PDO($dsn, $user, $pass);
    $query2 = "SELECT nom,prenom from utilisateur where ID=" . $row["ID_vendeur"];
    $result2 = $pdo2->query($query2);
    while ($row2 = $result2->fetch(PDO::FETCH_LAZY)) {
        echo "<tr><td rowspan='3'><p id=\"vendeur_objet\">Vendeur : " . $row2[0] . " " . $row2[1] . "</p></td>";
    }
    echo "<td><p id=\"prix_objet\">Prix de base : " . $row["prix_min"] . "€</p></td></tr>";
    if ($row["prix_enchereur"] > $row["prix_min"]) {
        echo "<tr><td><p id=\"prix_actuel\">Prix actuel : " . $row["prix_enchereur"] . "€</p></td></tr>";
    } else {
        echo "<tr><td><p id=\"prix_objet\">(Aucune enchere n'a encore étè faite :) ENJOY</p></td></tr>";
    }
    echo "</table> <br>";
    $GLOBALS["prix"]=$row["prix_min"];
}


$query = "SELECT ID from utilisateur where nom=\"".$_SESSION["nom"]."\" AND prenom=\"".$_SESSION["prenom"]."\"";
$result = $pdo->query($query);
$row=$result->fetch(PDO::FETCH_LAZY);

?>



    <form class="up" action="set_enchere.php" method="post" id="encherir">

        <p>Nouveau montant pour l'objet :</p>
        <input type="number" name="montant" id="montant" min="<?php echo $GLOBALS["prix"]+1; ?>">
        <input type="hidden" name="user" value="<?php echo $row["ID"]; ?>">
        <input type="hidden" name="objet" value="<?php echo $_POST["obj"]; ?>">
        <input type="submit" id="submit" value="Encherir !">
    </form>

<?php
include "info.php";
include "footer.html";
?>