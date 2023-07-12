<?php
require '../php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cedula = $_POST['cedula'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($password !== $confirmPassword) {
    $error = 'Las contraseñas no coinciden';
  } else {
    $query = "INSERT INTO Usuario (cedula, email, contraseña) VALUES (:cedula, :email, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    header('Location: login.html');
    exit();
  }
}

?>



