<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
<a href="app/crearEquipo.php"><button>Crear Equipo</button></a>
    <form action="index.php" method="post">

        <label for="operacion">Seleccionar operación:</label>
            <select id="operacion" name="operacion">
                <option value="eliminar">Eliminar</option>
                <option value="editar">Editar</option>
            </select>
        <button type="submit" class="action-btn">Aplicar a seleccionados</button>
        <?php 
        print($bodyOutput);
        ?>

    </form>
</body>
</html>