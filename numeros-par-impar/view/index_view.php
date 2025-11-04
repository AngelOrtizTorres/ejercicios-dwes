<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo Vista-Controlador</title>
</head>
<body>
    <p>
        <?php
            echo $data['message'];
            echo '<br>';
            foreach ($data['numbers'] as $num) {
                echo '<br>';
                echo $num;
            }
        ?>
    </p>
</body>
</html>