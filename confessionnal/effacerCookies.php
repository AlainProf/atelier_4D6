<?php

foreach($_COOKIE as $nom => $valeur)
{
    setCookie($nom, $valeur, time()-10);
}

echo "Cookie effacés<br>";