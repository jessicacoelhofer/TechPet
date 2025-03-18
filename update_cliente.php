<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $cliente_id = $data['cliente_id'];
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $animal = $data['animal'];
    $nome_animal = $data['nome_animal'];

    $conn = new mysqli("localhost", "root", "", "petshop");

    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Erro ao conectar ao banco de dados"]);
        exit;
    }

    $sql = "UPDATE clientes SET nome = ?, endereco = ?, telefone = ?, email = ?, animal = ?, nome_animal = ? WHERE cliente_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nome, $endereco, $telefone, $email, $animal, $nome_animal, $cliente_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cliente atualizado com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao atualizar cliente"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Dados inválidos"]);
}
?>
