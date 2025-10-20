<?php 
/**
 * @author Ángel Ortiz Torres
 * 22-09-2025
 * Ejercicio 5: Crear un calendario poniendo el mes y el año que quieras mostrar.
*/
include 'lib/function.php';
session_start();

if (!isset($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [];
}

$fecha = date('d-n-Y');
$msgErrorTarea = "";
// Declaración de variables
$mes = $_POST['mes'] ?? date('n');
$año = $_POST['anio'] ?? date('Y');

if (!$mes || !$año) {
    echo "Debes enviar un mes y un año válidos desde el formulario.";
}

// Definimos los festivos nacionales y locales en arrays asociativos
$festivosPorMes = [
    1  => [1, 6],                 // Enero
    2  => [28],                   // Febrero
    3  => [1],                    // Marzo
    4  => [17, 18, 21, 23],       // Abril
    5  => [1, 2],                 // Mayo
    6  => [24],                   // Junio
    7  => [25],                   // Julio
    8  => [15],                   // Agosto
    9  => [15],                   // Septiembre
    10 => [12],                   // Octubre
    11 => [1],                    // Noviembre
    12 => [6, 8, 25, 26],         // Diciembre
];

$festivosLocalesPorMes = [
    1  => [5],                    // Cabalgata de Reyes
    4  => [27],                   // Virgen de Belén
    5  => [4],                    // Batalla de las Flores
    9  => [8],                    // Virgen de la Fuensanta
    10 => [24],                   // San Rafael
];

// Si no existe el mes en el array, devolvemos un array vacío
$festivos = $festivosPorMes[$mes] ?? [];
$festivosLocal = $festivosLocalesPorMes[$mes] ?? [];


$numDiasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
$primerDiaSemana = date("w", mktime(0, 0, 0, $mes, 1 ,$año));
$numHuecos = ($primerDiaSemana + 6) % 7;

$tareasDia = $_SESSION['tareas'];
?>

<!--Vista-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        .sunday {
            color: red;
        }

        .fest {
            color: darkred;
        }

        .LocalFest {
            color: orangered;
        }

        .dias_boton {
            text-decoration: none;
            color: inherit; /* hereda el color del <td> */
        }
    </style>
</head>
<body>
    <h1>Calendario</h1>
    <form action="" method="post">
        <label for="">Mes:</label>
        <input type="number" name="mes" id="mes" min="1" max="12" value="<?php echo $mes?>" required>
        <label for="">Año:</label>
        <input type="number" name="anio" id="anio" min="1900" max="2100" value="<?php echo $año?>" required><br><br>
        <input type="submit" value="Enviar">
    </form><br><br>
    <?php
        echo "<h2>Mes: $mes, Año: $año</h2>";
    ?>
    <form method="post" action="">
        <button type="submit" name="grabarTareas">Grabar tareas</button>
    </form><br>

    <table border="1">
        <tr>
            <th>Lun</th>
            <th>Mar</th>
            <th>Mié</th>
            <th>Jue</th>
            <th>Vie</th>
            <th>Sáb</th>
            <th>Dom</th>
        </tr>
        <tr>
            <?php
            // Huecos antes del primer día
            for ($i = 0; $i < $numHuecos; $i++) {
                echo "<td></td>";
            }

            include 'config/form.php';

            $diaSemana = $numHuecos; // Empieza a poner los números después de añadir los huecos
            for ($dia = 1; $dia <= $numDiasMes; $dia++) {
                $fecha = "$dia-$mes-$año";
                if (in_array($dia, $festivos)) {
                    $clase = 'fest';
                } elseif (in_array($dia, $festivosLocal)) {
                    $clase = 'LocalFest';
                } elseif ($diaSemana == 6) {
                    $clase = 'sunday';
                } else {
                    $clase = '';
                }

                echo '<td' . ($clase ? ' class="'.$clase.'"' : '') . '>
                            <a href="calendar.php?fecha='.$fecha.'" class="dias_boton">
                                '.$dia.'
                            </a>
                    </td>';

                $diaSemana++;

                // Si llega a domingo (7 columnas), salto de fila
                if ($diaSemana == 7) {
                    echo "</td>";
                    if ($dia < $numDiasMes) {
                        echo "<tr>";
                    }
                    $diaSemana = 0;
                }
            }

            // Rellenar huecos finales si no acaba en domingo
            if ($diaSemana > 0) {
                for ($i = $diaSemana; $i < 7; $i++) {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
    </table>

    <?php
        echo '<h2><a href="save.php">Tareas:</a></h2>';
        echo "Fecha: $fecha<br>";
        echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?fecha=' . $fecha . '" method="POST">';
        echo '<input type="text" name="tarea" value="">';
        echo $msgErrorTarea;
        echo '<input type="hidden" name="fecha" value="' . $fecha . '">';
        echo '<br>';
        echo '<input type="submit" value="Añadir" name="nueva">';
        echo '</form>';

        foreach ($tareas as $clave => $valor) {
            if ($valor["fecha"] == $fecha) {
                echo $valor["tarea"] . ' <a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?borrar=' . $clave . '&fecha=' . $fecha . '">Borrar</a><br>';
            }
        }
    ?>
</body>
</html>
