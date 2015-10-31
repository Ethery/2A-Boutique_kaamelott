<?php
if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();
if(!isset($_SESSION["nom"]))
{
    echo "<form id=\"mise_en_vente\" action=\"identification.php\" method=\"post\">";
    echo "<input type=\"submit\" id=\"enchere\" value=\"S'identifier\">";
    $_SESSION["dir"] = "index.php";
}
else
{
    echo "<form id=\"mise_en_vente\" action=\"upload/upload.php\" method=\"post\">";
    echo "<input type=\"submit\" id=\"enchere\" value=\"Mettre en vente !\">";
}

echo "</form>";
include "header.html";
try{
    include "db_id.php";
    $pdo = new PDO($dsn,$user,$pass);
    $query = "SELECT nom,description,prix_min,ID_vendeur,chemin_photo,prix_enchereur,date_affichage,date_cloture from objet";
    $result = $pdo->query($query);
    while ($row = $result->fetch(PDO::FETCH_LAZY))
    {
        if(strtotime($row["date_affichage"])<strtotime(date('d-m-Y')) && strtotime($row["date_cloture"])>strtotime(date('d-m-Y'))) {


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

            echo "<tr><td>";

            if (session_status() != PHP_SESSION_ACTIVE)
                session_start();
            if (isset($_SESSION["nom"])) {
                echo "<form action=\"encherir.php\" method=\"post\">";
                echo "<input type=\"submit\" id=\"enchere\" value=\"Encherir !\">";
            }
            echo "<input type=\"hidden\" name=\"obj\" value=\"" . $row["nom"] . "\">";
            echo "</form></td></tr>
                </table> <br>";
        }
    }
}catch (PDROExeption $e)
{
    die("Erreur : ".$e->getMessage());
}
?>

<?php include "info.php"; ?>

<?php include "footer.html";?>