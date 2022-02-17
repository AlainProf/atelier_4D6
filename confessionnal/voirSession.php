<?php
session_start();

    foreach($_SESSION as $cle=>$val)
    {
        echo "$cle : $val<br>";
    }

    if (count($_SESSION) < 1)
     echo "session est vide";