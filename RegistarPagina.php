
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguer de Espaços</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <h1>Aluguer de Espaços da Rocha</h1>
        <a href="login.php" class="login-button">Login</a>
    </header>

    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#about">Sobre</a></li>
            <li><a href="#services">Serviços</a></li>
            <li><a href="#contact">Contato</a></li>
        </ul>
    </nav>

    <main>
        <div class="form-container">
        <form action="registar.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <hr>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <hr>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>
            <hr>

            <label for="tipo_user">Tipo de Utildor:</label>
            <select id="tipo_user" name="tipo_user" required>
                <option value="Professor">Professor</option>
                <option value="Aluno">Aluno</option>
                <option value="Externo">Externo</option>
            </select><hr>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Registrar</button>

            <label><input type="checkbox"> Lembrar-me</label>
        </form>
        </div>
    </main>

    <p>já tem uma conta? <a href="LoginPagina.php">Entrar</a></p>
</form>
    </div>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Nosso Site. Todos os direitos reservados.</p>
        <p><a href="#">Política de Privacidade</a> | <a href="#">Termos de Uso</a></p>
    </footer>
</body>

</html>