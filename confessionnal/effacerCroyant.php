<?php
session_start();
include "biblio.php";
include "BDService.php";

initPhp();
$bd = new BDService();

Securite();

$del = "delete from croyants where id = " . $_GET['croyantASupprimer'];
$bd->MISEAJOUR($del);

header('Location:adminPardon.php');
exit();


//--------------------------------------------------------------------
//------------------------------
//
//------------------------------
function Securite()
{
    global $id;
    if (isset($_SESSION['admin']))
       if ($_SESSION['admin'] == 'Curé')
          return;
    die ("Tentative de piratage");   
}



