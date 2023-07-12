<?php
require '../php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cedula = $_POST['cedula'];
  $password = $_POST['password'];

  $query = "SELECT id, nombre FROM Usuario WHERE cedula = :cedula AND contraseña = :password";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':cedula', $cedula);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    session_start();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['nombre'];
    header('Location: inicio.php');
    exit();
  } else {
    $error = 'Cédula o contraseña incorrectas';
  }
}

?>


