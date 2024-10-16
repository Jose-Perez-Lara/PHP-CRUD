<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
    
<form action="crearEquipo.php" method="post">
    <h2>Crear Equipo</h2>

    <label for="nombreEquipo">Nombre del Equipo:</label>
    <input required type="text" id="nombreEquipo" name="nombreEquipo"></input><br>

    <label for="partidosGanados">Partidos Ganados:</label>
    <input required type="text" id="partidosGanados" name="partidosGanados"></input><br>

    <label for="partidosTotales">Partidos Totales:</label>
    <input required type="text" id="partidosTotales" name="partidosTotales"></input><br>

    <button type="submit">Crear</button>
</form>
<a href="../index.php"><button>Volver</button></a>


</body>
</html>
