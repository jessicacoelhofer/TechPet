<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $animal = $data['animal'];
    $nome_animal = $data['nome_animal'];

    $conn = new mysqli("localhost", "root", "", "petshop");

    if ($conn->connect_error) {
        echo json_encode(["message" => "Erro ao conectar ao banco de dados"]);
        exit;
    }

    $sql = "INSERT INTO clientes (nome, endereco, telefone, email, animal, nome_animal) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $endereco, $telefone, $email, $animal, $nome_animal);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Cliente cadastrado com sucesso!"]);
    } else {
        echo json_encode(["message" => "Erro ao cadastrar cliente"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Dados inválidos"]);
}
?>

