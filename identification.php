<?php
session_start();
include "header.html" ?>
    <form action="ident.php" method="post">
        <h1>Informations du vendeur</h1>
        Nom :
        <br>
        <input type="text" name="nom">
        <br>
        <br>
        Prenom :
        <br>
        <input type="text" name="prenom">
        <br>
        <br>
        Adresse :
        <br>
        <input type="text" name="adresse">
        <br>
        <br>
        Telephone :
        <br>
        <input type="tel" name="tel">
        <br>
        <br>
        <input type="submit" value="S'identifier pour cette session">
        <br>
    </form>

<?php include "info.php"; ?>
<?php include "footer.html" ?>