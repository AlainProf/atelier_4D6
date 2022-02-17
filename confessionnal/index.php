<?php
  //die('Ln 2');
  session_start();
  include('biblio.php');
  include("BDService.php");

  initPhp();
  $bd = new BDService;
  
  $identifiant = "";
  $motPasse = "";

  GererCookie();
  entete("Confesse"); 
  if (isset($_POST['soumettre']))
  {
      $ret = Validation();
  }

  
  corps("Confesse virtuelle");
  AfficherFormConnexion();
  pied();  
  
  
//------------------------------------------------------------------

//----------------------------------------
//
//----------------------------------------
function GererCookie()
{
   global $identifiant;
   global $motPasse;
   //echo "in GereCookie";
   if (isset($_COOKIE['confession_croyant']))
   {
     //echo " cookie est set<br>";
     $identifiant = $_COOKIE['confession_croyant'];
       $motPasse  = $_COOKIE['confession_motPasse'];
  }
}

//----------------------------------------
//
//----------------------------------------
function validation()
{
  global $bd;
  global $identifiant;  
  global $motPasse;

  $identifiant = $_POST['utilisateur'];
  $motPasse = $_POST['motDePasse'];

  $sel = "select * from Croyants where nom = '$identifiant' and motPasse = '$motPasse'";
  $res = $bd->selection($sel);

  if (!empty($res[0]))
  {
     if (SeRappelerDeLui())
     {
        InscrireCookie();
     }
     else
     {
        EffacerCooke();
     }

     $_SESSION['idCroyant'] = $res[0]['id'];

     if ($res[0]['nom'] == "Curé")
     {
        $_SESSION['admin'] = 'Curé';
        header("location:adminPardon.php");
        exit();
     }
     else
     {
        header("location:confession.php?idCroyant=" . $res[0]['id']);
        exit();
      }
  }
  else
  {
    die("mauvais utilisateur... ");
  }

  var_dump($res);
  die('ln 50');

}

//----------------------------------------
//
//----------------------------------------
function SeRappelerDeLui()
{
  return (isset($_POST['rappel']));
}

//----------------------------------------
//
//----------------------------------------
function InscrireCookie()
{
   global $identifiant;
   global $motPasse;
   if (isset($identifiant)) 
   {
    //die ("init cookie<br>");
     setCookie('confession_croyant', $identifiant, time()+36000);
     setCookie('confession_motPasse', $motPasse, time()+36000);
   }
}

//----------------------------------------
//
//----------------------------------------
function EffacerCooke()
{
  setCookie('confession_croyant', '', time()-10);
  setCookie('confession_motPasse', '', time()-10);
}



//----------------------------------------
//
//----------------------------------------
function AfficherFormConnexion()
{
   global $identifiant;
   global $motPasse;
   $rappel = false;


  if (strlen($identifiant) > 0)
     $rappel = true;

	echo "
	<form method='post'>
	   Nom utilisateur: <input type='text' name='utilisateur' value='$identifiant'><br>
	   Mot de passe   :<input type='password' name='motDePasse' value ='$motPasse'><br>
	   Se rappeler de moi:<input type='checkbox' name='rappel'";

  if ($rappel)     
    echo " checked";

  echo ">  
	   <input class='btn btn-success' type='submit' value='se connecter' name='soumettre'>
	</form>
  <a class='btn btn-info' href='creationCompte.php'>Créer un compte</a><br><br>
  <a class='btn btn-warning' href='voirCookies.php'>Afficher cookies</a><br><br>
  <a class='btn btn-warning' href='effacerCookies.php'>Effacer cookies</a><br><br>
  <a class='btn btn-danger' href='voirSession.php'>Voir session</a><br><br>
  <a class='btn btn-danger' href='viderSession.php'>Vider Session</a><br><br>
  ";
}	


