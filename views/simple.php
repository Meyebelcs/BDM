<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Envío de Archivos</title>
</head>
<body>
    <form action="../controllers/simple.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecciona un archivo:</label>
        <input type="file" id="file" name="file">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>