<?php
session_start();
include "biblio.php";
include "BDService.php";

initPhp();
$bd = new BDService();

Securite();

entete("pardon");
corps("Confessions de vos ouailles");

AfficherEcranPardon();

Accueil();
pied();



//---------------------------------------------------------------------

//------------------------------
//
//------------------------------
function AfficherEcranPardon()
{
   echo "
   <div class='container'>
      <section class='row'>
         <article class='col-3'>";

   AfficherCroyants();
   
   echo "
         </article>

         <article class='col-3'>";
   AfficherPeches();
   
   echo "
         </article>
       </section>
     </div>    ";
}

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


//------------------------------
//
//------------------------------
function AfficherCroyants()
{
    global $bd;

    $sel = "select * from croyants where nom != 'Curé'";
    $res = $bd->selection($sel);

    echo "
    <table class='table'>
      <tr>
         <th>id Croyant</th><th>Nom</th><th>Action</th>
      </tr>";

    foreach($res as $unCroyant)  
    {
        echo "
        <tr>
           <td>" . $unCroyant['id'] . "</td>
           <td>" . $unCroyant['nom'] . "</td>
           <td><a class ='btn btn-danger' href='effacerCroyant.php?croyantASupprimer=" . $unCroyant['id'] . "'>Supprimer</a></td>
        </tr>";
    }

    echo "</table>";
}

//------------------------------
//
//------------------------------
function AfficherPeches()
{
    global $bd;

    $sel = "select * from peches";
    $res = $bd->selection($sel);

    echo "
    <table class='table'>
      <tr>
         <th>id Croyant</th><th>Aveu</th><th>Statut</th><th>Action</th>
      </tr>";

    foreach($res as $unPeche)  
    {
        echo "
        <tr>
           <td>" . $unPeche['idCroyant'] . "</td>
           <td>" . $unPeche['peche'] . "</td>
           <td>" . $unPeche['statut'] . "</td>";

        if ($unPeche['statut'] == 'initial')
           echo "
           <td><a class ='btn btn-warning' href='pardonnerPeche.php?pecheAPardonner=" . $unPeche['id'] . "'>Accorder pardon</a></td>";
        else
           echo "
           <td><a>Pardonné</a></td>";
                 
        echo "</tr>";
    }

    echo "</table>";
   
}


