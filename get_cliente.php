<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Verifica se o parâmetro 'id' foi enviado na URL
if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "petshop");

    if ($conn->connect_error) {
        echo json_encode(["message" => "Erro ao conectar ao banco de dados"]);
        exit;
    }

    // Consulta para buscar os dados do cliente com base no cliente_id
    $sql = "SELECT * FROM clientes WHERE cliente_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou o cliente
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        echo json_encode($cliente); // Retorna os dados do cliente em formato JSON
    } else {
        echo json_encode(["message" => "Cliente não encontrado"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "ID do cliente não fornecido"]);
}
?>
