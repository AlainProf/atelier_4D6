<?php

    if (count($_COOKIE) > 0)
    {
      foreach($_COOKIE as $nom => $valeur)
      {
        echo "$nom : $valeur<br>";
      }
    }
    else{
        echo "Aucun cookie<br>";
    }



