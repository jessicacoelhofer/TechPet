<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento - TechPet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0e0df; /* Marrom claro */
            color: #4a4a4a; /* Cor do texto */
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #308fac; /* Azul turquesa */
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        .menu-toggle {
            background-color: #d36882; /* Rosa */
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        .menu-toggle:hover {
            background-color: #c05573; /* Rosa mais escuro */
        }
        nav {
            position: absolute;
            top: 50px;
            right: 20px;
            background-color: white;
            border: 2px solid #d36882; /* Rosa */
            border-radius: 5px;
            display: none; /* Menu começa oculto */
            flex-direction: column;
            align-items: flex-start;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 10px;
        }
        nav ul li {
            margin-bottom: 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #4a4a4a; /* Texto escuro */
            font-weight: bold;
            padding: 10px 20px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #f0d8de; /* Rosa claro */
        }
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        form {
            background-color: white;
            border: 2px solid #da8298; /* Rosa */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        form input, form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: #d36882; /* Rosa */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        form button:hover {
            background-color: #c05573; /* Rosa mais escuro */
        }
        footer {
            background-color: #308fac; /* Azul turquesa */
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>TechPet</h1>
        <button class="menu-toggle">Menu</button>
        <nav id="menu">
            <ul>
                <li><a href="menu.php">Início</a></li>
                <li><a href="cadastro.html">Cadastro</a></li>
                <li><a href="clientes.html">Clientes</a></li>
                <li><a href="consulta_agendamentos.php">Agendamentos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Editar Agendamento</h1>
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

        if (isset($_GET['edit_id'])) {
            $edit_id = intval($_GET['edit_id']);
            $result = $mysqli->query("SELECT * FROM agendamentos WHERE id = $edit_id");

            if ($result && $result->num_rows > 0) {
                $agendamento = $result->fetch_assoc();
            } else {
                echo "<p>Agendamento não encontrado.</p>";
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id']);
            $cliente = $mysqli->real_escape_string($_POST['cliente']);
            $servico = $mysqli->real_escape_string($_POST['servico']);
            $data = $mysqli->real_escape_string($_POST['data_agendamento']);
            $hora = $mysqli->real_escape_string($_POST['hora_agendamento']);

            $sql = "UPDATE agendamentos SET cliente = '$cliente', servico = '$servico', data_agendamento = '$data', hora_agendamento = '$hora' WHERE id = $id";

            if ($mysqli->query($sql)) {
                echo "<p>Agendamento atualizado com sucesso!</p>";
                echo "<a href='consulta_agendamentos.php'>Voltar para Consulta de Agendamentos</a>";
                exit;
            } else {
                echo "<p>Erro ao atualizar agendamento: " . $mysqli->error . "</p>";
            }
        }
        ?>

        <form method="POST" action="editar_agendamento.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($agendamento['id']); ?>">
            <input type="text" name="cliente" placeholder="Cliente" value="<?php echo htmlspecialchars($agendamento['cliente']); ?>" required>
            <input type="text" name="servico" placeholder="Serviço" value="<?php echo htmlspecialchars($agendamento['servico']); ?>" required>
            <input type="date" name="data_agendamento" value="<?php echo htmlspecialchars($agendamento['data_agendamento']); ?>" required>
            <input type="time" name="hora_agendamento" value="<?php echo htmlspecialchars($agendamento['hora_agendamento']); ?>" required>
            <button type="submit">Atualizar</button>
        </form>
    </main>
    <footer>
        <p>© 2024 TechPet - Todos os direitos reservados.</p>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const menu = document.getElementById('menu');

        menuToggle.addEventListener('click', () => {
            if (menu.style.display === 'flex') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'flex';
            }
        });
    </script>
</body>
</html>
