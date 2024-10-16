<?php
include 'vars.php';

function getListFromDB($table){
    $list=array();
    global $servername, $username, $password, $dbname;
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    try {
        
        $stmt = $conn->prepare("SELECT * FROM equipos");
        $stmt->execute();
    
        
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } catch(PDOException $e) {
        echo "Error al realizar la consulta: " . $e->getMessage();
    }

    $conn = null;

    return $list;
}

function dump($var){
    echo '<pre>' . print_r($var,1) . '</pre>';
}

function unirAmbosArrays($array1,$array2){


    $equipos = $array1;
    $jugadores = $array2;

    foreach ($equipos as $idE => &$equipo) {

        $auxList=array();
        foreach ($jugadores as $key => $value) {
            if($value['idEquipo']==$equipo['idEquipo']){
                array_push($auxList,$value);
            }
        }

        $equipo['plantilla'] = $auxList;
    }
    return $equipos;
}

function getFormMarkup($table,$action){
    $output='<form action="'.$action.'" method="post">';
    foreach ($table as $registro) {
            $output.='<h1>Equipo '.$registro[0]['idEquipo'].'</h1>';
            $output.='<label for="nombreEquipo">Nombre del Equipo:</label>';
            $output.='<input required type="text" id="nombreEquipo" name="equipo'.$registro[0]['idEquipo'].'[nombreEquipo]"value="'.$registro[0]['nombreEquipo'].'"><br>';

            $output.='<label for="nombreEquipo">Partidos Ganados:</label>';
            $output.='<input required type="text" id="partidosGanados" name="equipo'.$registro[0]['idEquipo'].'[partidosGanados]" value="'.$registro[0]['partidosGanados'].'"><br>';
            
            $output.='<label for="nombreEquipo">Partidos Totales:</label>';
            $output.='<input required type="text" id="partidosTotales" name="equipo'.$registro[0]['idEquipo'].'[partidosTotales]" value="'.$registro[0]['partidosTotales'].'"><br>';

            $output.='<input style="display:none;" required type="text" id="idEquipo" name="equipo'.$registro[0]['idEquipo'].'[idEquipo]" value="'.$registro[0]['idEquipo'].'"><br>';
        
    }
    $output.='<button type="submit">editar</button>';
    $output.='</form>';
    return $output;

}


function getTableMarkup($list,$mode=0){
    $output='<table>';


    $cols = array_keys($list[0]);
    $output.= '<tr>';
    if($mode == 1){
        $output.= '<th>Seleccionar</th>';
    }

    foreach ($cols as  $value) {
        $output.= '<th>' . $value . '</th>';
    }

    $output.= '</tr>';

    foreach ($list as  $registro) {

        $output.= '<tr>';
        if($mode==1){
            
            $output.="<td><input type='checkbox'  name='registros[]' value='" . $registro['idEquipo'] . "'></td>";
        }

        foreach ($registro as $fila) {

            $output.='<td>';

            if(is_array($fila)){
                $output.= '<ul>';
                foreach ($fila as  $value) {

                    $output.= '<li>' . $value['nombreJugador'] . '</li>';
                }
                $output.= '</ul>';

            }else{
                $output.= $fila ;
            }

            $output.='</td>';
            
        }
        
        if($mode==1){
            $output.='<td><a href="app/verEquipo.php?idEquipo='.$registro['idEquipo'].'">Ver</a></td>';
        }
        
    $output.= '</tr>';


    }
    $output.= '</table>';

    return $output;
}

function getRegistDB($id){
    $list = array();
    global $servername, $username, $password, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    try {
        
        $stmt = $conn->prepare("SELECT * FROM equipos WHERE idEquipo= :idEquipo");
        $stmt->bindParam(':idEquipo', $id, PDO::PARAM_INT);

        $stmt->execute();
    
        
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } catch(PDOException $e) {
        echo "Error al realizar la consulta: " . $e->getMessage();
    }

    $conn = null;
    return $list;

}
function delete($id){
    global $servername, $username, $password, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    try {
        
        $stmt = $conn->prepare("DELETE FROM equipos WHERE idEquipo = :idEquipo");
        $stmt -> bindParam(':idEquipo',$id, PDO::PARAM_INT);

        $stmt->execute();
    
        
    } catch(PDOException $e) {
        echo "Error al realizar la consulta: " . $e->getMessage();
    }

    $conn = null;
}

function comprobarFilaId($fila,$idEliminar,$modo){return $modo?$fila['idEquipo']==$idEliminar:$fila['idEquipo']!=$idEliminar;}

function createTeam($nombreEquipo,$partidosGanados,$partidosTotales){
    global $servername, $username, $password, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    try {
        
        $stmt = $conn->prepare("INSERT INTO equipos(nombreEquipo, partidosGanados, partidosTotales) VALUES(:nombreEquipo,:partidosGanados,:partidosTotales)");
        $stmt->bindParam(':nombreEquipo', $nombreEquipo, PDO::PARAM_STR);
        $stmt->bindParam(':partidosGanados', $partidosGanados, PDO::PARAM_INT);
        $stmt->bindParam(':partidosTotales', $partidosTotales, PDO::PARAM_INT);

        $stmt->execute();
    
        
    } catch(PDOException $e) {
        echo "Error al realizar la consulta: " . $e->getMessage();
    }

    $conn = null;
}

function editTeam($nombreEquipo,$partidosGanados,$partidosTotales,$idEquipo){
    global $servername, $username, $password, $dbname;
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    try {
        
        $stmt = $conn->prepare("UPDATE equipos 
        SET nombreEquipo = :nombreEquipo, partidosGanados = :partidosGanados, partidosTotales = :partidosTotales
        WHERE idEquipo = :idEquipo");
        $stmt->bindParam(':nombreEquipo', $nombreEquipo, PDO::PARAM_STR);
        $stmt->bindParam(':partidosGanados', $partidosGanados, PDO::PARAM_INT);
        $stmt->bindParam(':partidosTotales', $partidosTotales, PDO::PARAM_INT);
        $stmt->bindParam(':idEquipo', $idEquipo, PDO::PARAM_INT);

        $stmt->execute();
    
        
    } catch(PDOException $e) {
        echo "Error al realizar la consulta: " . $e->getMessage();
    }

    $conn = null;

}
?>