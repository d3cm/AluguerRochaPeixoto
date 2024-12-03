<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - Aluguer de Espaços da Rocha</title>
</head>

<body>
    <!-- Header -->
    <header>
        <h1>Aluguer de Espaços da Rocha</h1>
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
        <!-- Container de Login -->
        <div class="form-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" id="username" name="username" placeholder="Nome de Utilizador" required>
                <input type="password" id="password" name="password" placeholder="Senha" required>
                <label><input type="checkbox"> Lembrar-me</label>
                <button type="submit" class="login-button">Entrar</button>
                <a href="#">Esqueceu a senha?</a>
                <p>Não tem uma conta? <a href="RegistarPagina.php">Registrar-se</a></p>
            </form>
        </div>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Nosso Site. Todos os direitos reservados.</p>
        <p><a href="#">Política de Privacidade</a> | <a href="#">Termos de Uso</a></p>
    </footer>
</body>

</html>