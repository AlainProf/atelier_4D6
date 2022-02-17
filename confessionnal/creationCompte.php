<?php
session_start();
include "biblio.php";
include "BDService.php";

initPhp();
$bd = new BDService();

entete("Creation compte");
corps("Création de compte");

if (isset($_POST['soumettre']))
{
    
    $ret = Validation();
    if ($ret >= 0)
    {
        $d = date('Y-m-d H:i:s');
        $ins = "insert into Croyants value (null, '$identifiant', '$motPasse', '$d')";
        $idCroyant = $bd->insertion($ins);
        
        $_SESSION['idCroyant'] = $idCroyant;
        header("location:confession.php?idCroyant=$idCroyant");
        exit();
    }
    else{
        echo "Erreur $ret<br>";
    }
    
}

AfficherFormCreation();
Accueil();

pied();



//---------------------------------------------------------------------

//------------------------------
//
//------------------------------
function Validation()
{
    global $identifiant;
    $identifiant = $_POST['identifiant'];
    global $motPasse;
    $motPasse = $_POST['motPasse'];
    $confirmation = $_POST['confirmation'];

    $codeErr = 0;
    if (strlen($identifiant)> 15)
       $codeErr = -1;
    if (strlen($identifiant)< 2)
       $codeErr = -2;
    if (strlen($motPasse)> 15)
       $codeErr = -3;
    if (strlen($motPasse)< 2)
       $codeErr = -4;
    if ($confirmation !== $motPasse)       
       $codeErr = -5;
    return $codeErr;       
       
}


//------------------------------
//
//------------------------------
function AfficherFormCreation()
{
    echo "
    <form method='post'>
       Identifiant désiré : <input type='text' name='identifiant'><br>
       Mot de passe : <input type='password' name='motPasse'><br>
       Confirmation : <input type='password' name='confirmation'><br>
       <input type='submit' name='soumettre' value='Créer le compte'>
    </form>";
}

