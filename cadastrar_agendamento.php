<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Agendamento - TechPet</title>
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
        }
        header h1 {
            margin: 0;
            font-size: 24px;
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
        .form-container {
            background-color: white;
            border: 2px solid #da8298; /* Rosa */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .form-container input, .form-container textarea, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container button {
            background-color: #d36882; /* Rosa */
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        .form-container button:hover {
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
    </header>
    <main>
        <div class="form-container">
            <h2>Cadastrar Agendamento</h2>
            <form action="processa_agendamento.php" method="POST">
                <input type="text" name="cliente" placeholder="Nome do Cliente" required>
                <input type="text" name="servico" placeholder="Serviço" required>
                <input type="date" name="data_agendamento" required>
                <input type="time" name="hora_agendamento" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 TechPet - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
