<?php
require_once 'connect.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipo_user = $_POST['tipo_user'];
    $senha = $_POST['senha'];

    // Insere o novo utilizador na base de dados
    $stmt = $con->prepare("INSERT INTO utilizador (nome, email, telefone, tipo_user, senha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $telefone, $tipo_user, $senha);
    $stmt->execute();
    $stmt->close();
    $con->close();

    header("Location: index.php");
}
?>
