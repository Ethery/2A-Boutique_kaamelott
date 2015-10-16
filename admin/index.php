<?php
session_start();
include "../header.html" ?>
    <form action="clean.php" method="post">
        <h1>Identification administrateur :</h1>
        ID :
        <br>
        <input type="text" name="ID">
        <br>
        <br>
        Mot de passe :
        <br>
        <input type="password" name="MDP">
        <br>
        <br>
        <input type="submit" value="S'identifier pour cette session.">
        <br>
        <br>
    </form>

<?php include "../info.php"; ?>
<?php include "../footer.html" ?>