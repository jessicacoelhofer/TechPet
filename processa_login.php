<?php
// Configuração do banco de dados
$host = 'localhost';
$dbname = 'petshop';
$username = 'root';
$password = ''; 

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['usuario']) || empty($_POST['senha'])) {
        echo "Preencha todos os campos.";
        exit;
    }

    $user = $mysqli->real_escape_string($_POST['usuario']);
    $pass = $mysqli->real_escape_string($_POST['senha']);

    // Use prepared statements para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();

        // Inicia a sessão
        session_start();
        $_SESSION['id'] = $userData['id'];
        $_SESSION['usuario'] = $userData['usuario'];

        // Redireciona para o menu
        header("Location: menu.php");
        exit;
    } else {
        echo "Falha ao logar! Usuário ou senha incorretos.";
    }
} else {
    echo "Método inválido.";
}
