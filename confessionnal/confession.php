<?php
session_start();
include "biblio.php";
include "BDService.php";

initPhp();
$bd = new BDService();

$id = $_GET['idCroyant'];

Securite();
//$identifiant = $_GET['identifiant'];

$sel = "select nom from croyants where id = $id";
$res = $bd->selection($sel);

if (empty($res[0]))
  die("Mauvais id de ccroyant");


entete("confesse");
corps("<b>" . $res[0]['nom'] . "</b>, videz vous le coeur sans retenue");

if (isset($_POST['soumettre']))
{
    $ret = Validation();
    if ($ret >= 0)
    {
        $d = date('Y-m-d H:i:s');

        
        $ins = "insert into peches value (null, '$id', '$pecheAvoue', '$d', 'initial', '$d')";
        $bd->insertion($ins);
    }
    else{
        echo "Erreur $ret<br>";
    }
    
}

AfficherFormConfession();
AfficherHistorique();

Accueil();

pied();



//---------------------------------------------------------------------

//------------------------------
//
//------------------------------
function Securite()
{
    global $id;
    if (isset($_SESSION['idCroyant']))
       if ($_SESSION['idCroyant'] == $id)
          return;
    die ("Tentative de piratage");   
}


//------------------------------
//
//------------------------------
function AfficherHistorique()
{
    global $id;
    global $bd;
    $sel = "select * from peches where idCroyant = $id";
    $res = $bd->selection($sel);
    //var_dump($res);
    //die();

    echo "
    <table class='table'>
      <tr>
         <th>Péché commis</th><th>Date commis</th><th>Statut</th><th>Date statut</th>
      </tr>";

    foreach($res as $unPeche)  
    {
        echo "
        <tr>
           <td>" . $unPeche['peche'] . "</td><td>" . $unPeche['date'] . "</td><td>" . $unPeche['statut'] . "</td><td>" . $unPeche['dateStatut'] . "</td>
        </tr>";
    }

    echo "</table>";
}

//------------------------------
//
//------------------------------
function Validation()
{
    global $pecheAvoue;
    $pecheAvoue = $_POST['pecheAvoue'];

    $codeErr = 0;
    if (strlen($pecheAvoue)> 200)
       $codeErr = -6;
    if (strlen($pecheAvoue)< 5)
       $codeErr = -7;
    return $codeErr;       
       
}


//------------------------------
//
//------------------------------
function AfficherFormConfession()
{
    echo "
    <form method='post'>
       Aveu : <input type='text' name='pecheAvoue'><br>
       <input class='btn btn-danger' type='submit' name='soumettre' value='Avouer votre faute'>
    </form>";
}

