<?php
include('connect.php');
session_start();

// Verifica se o utilizador está logado
if (!isset($_SESSION['id'])) {
    header("Location: LoginPagina.php");
    exit;
}

$id = $_SESSION['id'];

// Obtém os dados do utilizador
$sql = "SELECT * FROM utilizador WHERE id_utilizador = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Erro: Utilizador não encontrado.";
    exit;
}

// Atualiza os dados do utilizador se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    $update_sql = "UPDATE utilizador SET nome = ?, email = ?, telefone = ?, senha = ? WHERE id_utilizador = ?";
    $update_stmt = $con->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $nome, $email, $telefone, $senha, $id);

    if ($update_stmt->execute()) {
        header("Refresh: 2; url=logado.php");
    } else {
        echo "Erro ao atualizar o perfil: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Editar Perfil</h1>
        <a href="logado.php" class="back-button">Voltar</a>
    </header>
    <main>
        <form action="" method="POST">
            <div class="form-container">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($user['telefone']) ?>" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?= htmlspecialchars($user['senha']) ?>" required>

            <button type="submit">Salvar Alterações</button>
            </div>
        </form>
    </main>
</body>
</html>
