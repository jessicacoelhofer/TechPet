<?php

if(!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechPet - Página Inicial</title>
    
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
        main h1 {
            color: #d36882; /* Rosa */
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            color: white;
            background-color: #d36882; /* Rosa */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
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
                <li><a href="consulta_agendamentos.php">Agendamentos</a></li>
                <li><a href="cadastro.html">Cadastro</a></li>
                <li><a href="clientes.html">Clientes</a></li>
                <li><a href="cadastrar_agendamento.php">Novo Agendamento</a></li> <!-- Link para cadastro de agendamento -->
            </ul>
        </nav>
    </header>
    <main>
        <h1>Bem-vindo a TechPet! <a><?php echo $_SESSION['usuario']; ?> </a></h1>
        <p>O sistema ideal para gerenciar seu PetShop.</p>
        <a href="consulta_agendamentos.php" class="btn">Agendamentos</a>
        <a href="cadastro.html" class="btn">Cadastro</a>
        <a href="clientes.html" class="btn">Clientes</a>
        <a href="cadastrar_agendamento.php" class="btn">Novo Agendamento</a> <!-- Botão para cadastro de agendamento -->
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
