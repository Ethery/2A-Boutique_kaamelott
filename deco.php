<?php
include "header.html";

session_start();
include "info.php";
if(session_status()==PHP_SESSION_ACTIVE)
{
    $_SESSION=[];
    session_destroy();
}
echo "Vous avez été deconnécté :)";

header('Location: index.php');
include "info.php";

?>