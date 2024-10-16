<?php
    include_once('functions.php');

    $registro=getRegistDB($_GET);
    $bodyOutput = getTableMarkup($registro);

    include_once('../templates/templateVerEquipo.php');

?>