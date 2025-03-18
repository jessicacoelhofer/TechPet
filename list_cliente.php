<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// list_cliente.php

require 'db.php';

header("Content-Type: application/json");

$stmt = $pdo->query("SELECT * FROM clientes ORDER BY cliente_id DESC");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($clientes);
?>
