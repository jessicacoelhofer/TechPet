<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Agendamentos - TechPet</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #d36882;
            color: white;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            color: #c05573;
            font-size: 18px;
        }
        footer {
            background-color: #308fac; /* Azul turquesa */
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .action-buttons button {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #308fac;
            color: white;
        }
        .btn-delete {
            background-color: #d36882;
            color: white;
        }
        .btn-edit:hover {
            background-color: #267a94;
        }
        .btn-delete:hover {
            background-color: #c05573;
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
        <h1>Consulta de Agendamentos</h1>
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

        // Exclusão de agendamento
        if (isset($_GET['delete_id'])) {
            $delete_id = intval($_GET['delete_id']);
            $mysqli->query("DELETE FROM agendamentos WHERE id = $delete_id");
            echo "<p>Agendamento excluído com sucesso!</p>";
        }

        // Consulta os agendamentos no banco de dados
        $sql = "SELECT * FROM agendamentos ORDER BY data_agendamento, hora_agendamento";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                            <td><?php echo htmlspecialchars($row['servico']); ?></td>
                            <td><?php echo htmlspecialchars($row['data_agendamento']); ?></td>
                            <td><?php echo htmlspecialchars($row['hora_agendamento']); ?></td>
                            <td class="action-buttons">
                                <form action="editar_agendamento.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn-edit">Editar</button>
                                </form>
                                <form action="consulta_agendamentos.php" method="GET" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este agendamento?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn-delete">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">Nenhum agendamento encontrado.</p>
        <?php endif; ?>
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
