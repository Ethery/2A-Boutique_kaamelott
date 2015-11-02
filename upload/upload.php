<?php include "../header.html";
session_start();?>
    <h1 class="up">Informations de l'objet</h1>
    <form class="up" action="sell4.php" method="post" enctype="multipart/form-data">
        <p>Nom de l'objet:</p>
        <input type='text' name='nom_obj'>
        <br>
        <br>
        <p><label for="photo">Photo (PNG ou JPEG | max. 1 Go) :</label></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="1073741824" />
        <input type="file" name="photo" id="photo" />
        <br>
        <br>
        <p>Prix minimum de vente:</p>
        <input type="number" name="prix_min" min=0 max=9223372036854775807>
        <br>
        <br>
        <p>Date de début:</p>
        <input type='date' name='date_debut'>
        <br>
        <br>
        <p>Date de fin:</p>
        <input type='date' name='date_fin'>
        <br>
        <br>
        <p>Description:</p>
        <textarea maxlength="800" name='description'></textarea>
        <br>
        <br>
        <input type="submit" value="Mettre en vente">
    </form>
<?php
include "../footer.html";
include "../info.php";
?>