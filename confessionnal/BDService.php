<?php
class BDService
{
    private $bdInterne;

    //-----------------------------------------------
    //
    //-----------------------------------------------
    public function __construct()
    {
        $this->bdInterne = new mysqli(SERVEUR, UTILISATEUR, MOT_PASSE, BD);
        if (mysqli_connect_errno()) {
            $message = "impossible de se connecter: mysqli_connect_error";
            throw new Exception($message);
        }
        $this->bdInterne->set_charset('UTF8');
    }

    //-----------------------------------------------
    //
    //-----------------------------------------------
    public function miseAJour($upd)
    {
        $resultat = $this->bdInterne->query($upd);
        if (!$resultat) {
            throw new Exception("ERREUR : requête non conforme ($upd).");
        }
        return $this->bdInterne->affected_rows;
    }

    //-----------------------------------------------
    //
    //-----------------------------------------------
    public function selection($sel)
    {
        $tableau = array();
        $resultat = $this->bdInterne->query($sel);
        if (!$resultat) 
        {
            throw new Exception("ERREUR : sélection non conforme ($sel).");
        }

        while($enregistrement = $resultat->fetch_array(MYSQLI_ASSOC))
        {
            $tableau[] = $enregistrement;
        }
        return $tableau;
    }

    //-----------------------------------------------
    //
    //-----------------------------------------------
    public function insertion($ins)
    {
        $resultat = $this->bdInterne->query($ins);
        if (!$resultat) {
            throw new Exception("ERREUR : requête non conforme ($ins).");
        }
        return $this->bdInterne->insert_id;
    }
	
    //-----------------------------------------------
    //
    //-----------------------------------------------
	public function neutralise($text)
   {
      return $this->bdInterne->real_escape_string($text);
   }
}
