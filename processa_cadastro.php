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

// Habilitar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $confirma_senha = $mysqli->real_escape_string($_POST['confirma_senha']);

    // Verifica se os campos foram preenchidos
    if (empty($usuario) || empty($senha) || empty($confirma_senha)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Verifica se as senhas coincidem
    if ($senha !== $confirma_senha) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Verifica se o usuário já existe no banco de dados
    $stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Usuário já existe. Escolha outro nome.";
        exit;
    }

    // Insere o novo usuário no banco de dados (sem criptografia da senha)
    $stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $senha);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
        header("Location: login.php"); // Redireciona para o login
        exit;
    } else {
        echo "Erro ao cadastrar usuário: " . $mysqli->error;
    }
}
?>
