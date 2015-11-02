<?php
session_start();
include "header.html" ?>
    <form action="ident.php" method="post">
        <h1>Informations :)</h1>
        <p>Nom :</p>
        <input type="text" name="nom">
        <br>
        <br>
        <p>Prenom :</p>
        <input type="text" name="prenom">
        <br>
        <br>
        <p>Adresse :</p>
        <input type="text" name="adresse">
        <br>
        <br>
        <p>Telephone :</p>
        <input type="tel" name="tel">
        <br>
        <br>
        <input type="submit" value="S'identifier pour cette session">
        <br>
    </form>

<?php include "info.php"; ?>
<?php include "footer.html" ?>