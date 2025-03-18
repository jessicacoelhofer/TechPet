<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $cliente_id = $data['cliente_id'];

    $conn = new mysqli("localhost", "root", "", "petshop");

    if ($conn->connect_error) {
        echo json_encode(["message" => "Erro ao conectar ao banco de dados"]);
        exit;
    }

    $sql = "DELETE FROM clientes WHERE cliente_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cliente_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Cliente deletado com sucesso!"]);
    } else {
        echo json_encode(["message" => "Erro ao deletar cliente"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Dados inválidos"]);
}
?>

