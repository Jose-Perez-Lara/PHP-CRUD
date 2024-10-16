<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
include_once('app/vars.php');
include_once('app/functions.php');

if(!empty($_POST['operacion'])){

    switch ($_POST['operacion']) {
        case 'eliminar':
            $idEquipos = $_POST['registros'];
            foreach ($idEquipos as $value) {
                
                delete($value);

            }
            
            break;

        case 'editar':
            header('Location: app/editEquipo.php?'.http_build_query($_POST['registros']));
            
            break;
        
        default:
            
            break;
    }
}

$bodyOutput = getTableMarkup(getListFromDB('equipos'),1);
    
include_once('templates/template1.php');

?>
