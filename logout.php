<?php
session_start();

// Verifica se uma sessão está ativa
if (isset($_SESSION['id'])) {
    // Destrói todas as variáveis de sessão
    $_SESSION = [];

    // Destroi a sessão
    session_destroy();

    // Opcional: remove os cookies de sessão se necessário
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
}

// Redireciona para a página inicial ou página de login
header("Location: index.php");
exit;
