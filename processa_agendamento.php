<?php
// Configuração do banco de dados
$host = 'localhost';
$dbname = 'petshop';
$username = 'root';
$password = '';

// Conexão com o banco de dados
$mysqli = new mysqli($host, $username, $password, $dbname);

// Verifica se há erros na conexão
if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza e obtém os dados do formulário
    $cliente = $mysqli->real_escape_string($_POST['cliente']);
    $servico = $mysqli->real_escape_string($_POST['servico']);
    $data_agendamento = $mysqli->real_escape_string($_POST['data_agendamento']);
    $hora_agendamento = $mysqli->real_escape_string($_POST['hora_agendamento']);

    // Validações básicas
    if (empty($cliente) || empty($servico) || empty($data_agendamento) || empty($hora_agendamento)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
        exit;
    }

    // Insere os dados na tabela de agendamentos
    $sql = "INSERT INTO agendamentos (cliente, servico, data_agendamento, hora_agendamento) VALUES ('$cliente', '$servico', '$data_agendamento', '$hora_agendamento')";

    if ($mysqli->query($sql)) {
        echo "<script>alert('Agendamento cadastrado com sucesso!'); window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar agendamento: " . $mysqli->error . "'); window.history.back();</script>";
    }
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
