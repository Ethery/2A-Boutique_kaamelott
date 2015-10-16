<?php
session_start();
function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
//Test1: fichier correctement uploadé
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
//Test2: taille limite
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
//Test3: extension
    $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
//Déplacement
    return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

//EXEMPLES
$new_image_name = 'image_' . date('d-m-Y') . '_' . uniqid() . '.jpg';
$upload1 = upload('photo', '../photos/'.$new_image_name,1048576, array('png','jpg','jpeg') );
if ($upload1)
{
    echo "Upload de votre photo réussie!<br />";
    include "../db_id.php";

    try {
        $conn = new PDO($dsn, $user, $pass);
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT ID from utilisateur where nom='".$_SESSION["nom"]."'";
        $result = $conn->query($query);
        $row=$result->fetch(PDO::FETCH_LAZY);

        $sql = "INSERT INTO objet (nom, chemin_photo, prix_min, date_affichage, date_cloture,ID_vendeur,description) VALUES ('".$_POST["nom_obj"]."', '".$new_image_name."', '".$_POST['prix_min']."', '".$_POST['date_debut']."', '".$_POST['date_fin']."', '".$row["ID"]."', '".$_POST['description']."')";
// use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";

        header('Location: ../index.php');
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}
else
{
    echo "Erreur !<br />";
}
include "../info.php";
?>
