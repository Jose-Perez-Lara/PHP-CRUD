<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('functions.php');

if(!empty($_GET)){
    $data = $_GET;
    $entireList=array();
    
    foreach ($data as  $value) {
        $entireList[] =getRegistDB($value);
    }
    
    $formOutput = getFormMarkup($entireList,'editEquipo.php');
    include_once('../templates/templateEdit.php');
}else{
    $postData = $_POST;
    foreach ($postData as $key => $value) {
        editTeam($value['nombreEquipo'],$value['partidosGanados'],$value['partidosTotales'],$value['idEquipo']);
    }

    header('Location: ..');
} 




?>