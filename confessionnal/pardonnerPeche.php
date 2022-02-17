<?php
session_start();
include "biblio.php";
include "BDService.php";

initPhp();
$bd = new BDService();

Securite();

$d = date('Y-m-d H:i:s');

$del = "update peches  set  statut='pardonné' , dateStatut='$d' where id = " . $_GET['pecheAPardonner'];
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



