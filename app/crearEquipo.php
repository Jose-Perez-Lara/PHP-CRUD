<?php

include_once('functions.php');

if(!empty($_POST)){
    
createTeam($_POST['nombreEquipo'],$_POST['partidosGanados'],$_POST['partidosTotales']);

}



include_once('../templates/templateCreateTeam.php');

?>