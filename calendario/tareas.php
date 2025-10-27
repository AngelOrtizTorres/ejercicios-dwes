<?php 
/**
 * @author Ángel Ortiz Torres
 * 22-09-2025
 * Ejercicio 5: Crear un calendario poniendo el mes y el año que quieras mostrar.
 */
include 'lib/function.php';

session_start();

// Recogemos los datos enviados desde el calendario
if (!isset($_GET['dia']) || !isset($_GET['mes']) || !isset($_GET['anio'])) {
    header('Location: calendar.php');
    exit;
}

$dia  = $_GET['dia'];
$mes  = $_GET['mes'];
$año  = $_GET['anio'];
$procesaFormulario = false;

if (isset($_POST['nueva'])) {
    if (empty($_POST['tarea'])) {
        $msgErrorTarea = "<span>La tarea no puede estar vacía</span>";
    } else {
        $_SESSION['tareas'][] = array('fecha' => clearData($_POST['fecha']),
                                    'tarea' => clearData($_POST['tarea']));
    }

}
// Actualizar el array de tareas para mostrarlas inmediatamente
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
    <h1>Calendario</h1><br/>

    <h3>Tareas del día <?php echo $dia.'-'.$mes.'-'.$año; ?></h3>

    <ul>
    <?php
    // Mostrar tareas existentes
    foreach ($tareasDia as $tarea) {
        echo '<li>' . htmlspecialchars($tarea) . '</li>';
    }
    ?>
    </ul>

    <!-- Formulario para añadir nueva tarea -->
    <form method="post" action="tareas.php?fecha='.$strfecha.'" class="dias_boton">
        <input type="hidden" name="dia" value="<?php echo $dia; ?>">
        <input type="hidden" name="mes" value="<?php echo $mes; ?>">
        <input type="hidden" name="anio" value="<?php echo $año; ?>">
        
        <input type="text" name="nuevaTarea" placeholder="Escribe tu tarea" required>
        <button type="submit">Añadir tarea</button><br><br>
        <button><a href="calendar.php">Volver</a></button>
    </form>

</body>
</html>
