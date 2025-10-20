<?php

session_start();

if (!isset($_SESSION['tareas']) or !isset($_GET['id'])) {
    header('location: calendar.php');
}
$id = $_GET['id'];
$fecha = $_SESSION['tareas'][$id]['fecha'];
unset($_SESSION['tareas'][$id]);
header('location: calendar.php?fecha='.$fecha);
exit;
