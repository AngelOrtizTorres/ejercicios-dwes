<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
</head>
<body>
    <form action="./calendar.php" method="post">
        <label for="">Mes:</label>
        <input type="number" name="mes" id="mes" min="1" max="12" required>
        <label for="">Año:</label>
        <input type="number" name="anio" id="anio" min="1900" max="2100" required><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>