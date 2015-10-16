<?php include "../header.html";
session_start();?>
    <h1>Informations de l'objet</h1>
    <form action="sell4.php" method="post" enctype="multipart/form-data">
        Nom de l'objet:<br>
        <input type='text' name='nom_obj'>
        <br>
        <br>
        <label for="photo">Photo (PNG ou JPEG | max. 1 Go) :</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="1073741824" />
        <br>
        <input type="file" name="photo" id="photo" />
        <br>
        <br>
        Prix minimum de vente:<br>
        <input type="number" name="prix_min" min=0 max=9223372036854775807>
        <br>
        <br>
        Date de début:<br>
        <input type='date' name='date_debut'>
        <br>
        <br>
        Date de fin:<br>
        <input type='date' name='date_fin'>
        <br>
        <br>
        Description:<br>
        <textarea maxlength="800" name='description'></textarea>
        <br>
        <br>
        <input type="submit" value="Mettre en vente">
    </form>
<?php
include "../footer.html";
include "../info.php";
?>