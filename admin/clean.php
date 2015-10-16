<?php

include "../db_id.php";

if($_POST["ID"]="admin" && $_POST["MDP"]="admin")
{
    try {
        $conn = new PDO($dsn, $user, $pass);
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT ID,chemin_photo,date_cloture from objet";

        $result = $conn->query($query);

        while ($row = $result->fetch(PDO::FETCH_LAZY))
        {
            if(strtotime($row["date_cloture"])<=strtotime(date('d-m-Y')))
            {
                $sql = "DELETE FROM objet where ID=" . $row["ID"];
                $conn->exec($sql);
                echo "New record deleted succesfully";
                unlink('../photos/' . $row["chemin_photo"]);
            }
        }
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
    header('Location: ../index.php');
}

?>