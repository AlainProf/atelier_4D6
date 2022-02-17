<?php
define("SERVEUR", "localhost");
define( "UTILISATEUR","root");
define("MOT_PASSE","");
define("BD", "confessionnal");


//------------------------------
//
//------------------------------
function Accueil()
{
    echo "<br>
    <a href='index.php' class='btn btn-info'>Accueil</a>";
}

//------------------------------
//
//------------------------------
function initPhp()
{
  ini_set("date.timezone", "america/new_york");
} 

//------------------------------
//
//------------------------------
function Entete($titre)
{
    echo "
	<!DOCTYPE html>
<html lang='fr'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>$titre</title>
    <!-- CSS de Bootstrap compilé et minifié  -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  </head>";
}

//------------------------------
//
//------------------------------
function Corps($titre)
{
  echo "
   <body>
       <h1>$titre</h1>";
}

//------------------------------
//
//------------------------------
function Pied()
{
  
   echo "   
<!-- jQuery library -->
    <script
  src='https://code.jquery.com/jquery-3.6.0.min.js'
  integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4='
  crossorigin='anonymous'></script>
    <!-- Popper JS -->
    <script src='https://unpkg.com/@popperjs/core@2'></script>
    <!-- JavaScript compilé -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
	 </body>
 </html>";  
}

//------------------------------
//
//------------------------------
function voirPost()
{
	echo "Contenu du POST:<br>";
	foreach($_POST as  $cle => $valeur)
		echo $cle . " : " . $valeur . "<br>";
}

//------------------------------
//
//------------------------------
function voirGet()
{
	echo "Contenu du GET:<br>";
	foreach($_GET as  $cle => $valeur)
		echo "$cle  : $valeur <br>";
}
 
	   	
 