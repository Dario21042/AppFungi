<?php
try {
    $serverName = "tcp:serverfungi.database.windows.net,1433";
    $database = "FungiExplorer";
    $username = "administrador";
    $password = "fungi12@";
    
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>

