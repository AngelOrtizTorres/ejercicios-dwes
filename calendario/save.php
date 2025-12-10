<?php

session_start();
$tareas = $_SESSION['tareas'];
$file = "data/tareas.txt";
file_put_contents($file, json_encode($tareas));
session_unset();
session_destroy();
header('location: calendar.php');
exit;