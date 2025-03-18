<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechPet - Login</title>
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
            justify-content: center;
            align-items: center;
        }
        .logo h3 {
            font-size: 36px;
            color: #308fac; /* Azul turquesa */
        }
        .login-container {
            background-color: white;
            border: 2px solid #da8298; /* Rosa */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container input,
        .login-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-container button {
            background-color: #d36882; /* Rosa */
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="logo">
        <h3>TechPet</h3>
    </div>
    <div class="login-container">
        <form action="processa_login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p>Não possui uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</body>
</html>
