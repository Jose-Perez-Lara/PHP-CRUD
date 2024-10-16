<?php
    include 'app/vars.php';
    //se debe de tener el user creado y la base de datos
    global $servername, $username, $password, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        
        $conn->beginTransaction();
    
        
        $stmt1 = $conn->prepare("CREATE TABLE equipos (
        idEquipo INT AUTO_INCREMENT PRIMARY KEY,
        nombreEquipo VARCHAR(50),
        partidosGanados INT,
        partidosTotales INT)");
        $stmt1->execute();
    
        
        $stmt2 = $conn->prepare("INSERT INTO equipos (nombreEquipo, partidosGanados, partidosTotales) VALUES 
        ('Tigres FC', 18, 25),
        ('Águilas Doradas', 12, 25),
        ('Leones Rojos', 15, 25),
        ('Pumas Negros', 20, 25),
        ('Halcones Azules', 10, 25)");
        $stmt2->execute();
    
        
        $conn->commit();
        echo "Todas las sentencias se ejecutaron correctamente.";
    } catch(PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $conn = null;

    header('Location: index.php');

?>