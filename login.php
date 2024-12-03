<?php
session_start();

$con = new mysqli("localhost", "root", "", "alugel");

if ($con->connect_errno != 0) {
    echo "Erro no Acesso à Base de Dados " . $con->connect_error;
    exit;
}

if ($estado = $con->prepare("SELECT id_utilizador, nome, senha FROM utilizador WHERE nome=?")) {
    $estado->bind_param("s", $_POST["username"]);
    $estado->execute();
    $estado->store_result();

    if ($estado->num_rows > 0) {
        $estado->bind_result($id_utilizador, $username, $senha);
        $estado->fetch();

        if ($_POST["password"] === $senha) {
            $_SESSION['id'] = $id_utilizador;
            $_SESSION['username'] = $username;

            echo "Logged in successfully!";
            header("Location: logado.php?id=" . $id_utilizador);

            exit;
        } else {
            echo "Senha incorreta.";
            header("Refresh: 1; url=index.php");
            exit;
        }
    } else {
        echo "Os dados não foram validados. Introduza os dados corretos.";
        header("Refresh: 1; url=login.php");
        exit;
    }
} else {
    echo "Erro na consulta: " . $con->error;
}
?>
