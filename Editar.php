<?php
include('connect.php');

// Obtém o ID do utilizador a partir do parâmetro GET
$id_utilizador = $_GET['id_utilizador'];

// Consulta para buscar os dados do utilizador pelo ID
$sql = "SELECT * FROM utilizador WHERE id_utilizador = $id_utilizador";
$result = $con->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "Utilizador não encontrado.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Editar Utilizador</title>
</head>
<body>
    <form method="POST" action="editar_utilizador.php">
        <input type="hidden" name="id_utilizador" value="<?php echo $row['id_utilizador']; ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo $row['telefone']; ?>" required>

        <label>Tipo de Utilizador:</label>
        <select name="tipo_user" required>
            <option value="Professor" <?php if ($row['tipo_user'] == 'Professor') echo 'selected'; ?>>Professor</option>
            <option value="Aluno" <?php if ($row['tipo_user'] == 'Aluno') echo 'selected'; ?>>Aluno</option>
            <option value="Externo" <?php if ($row['tipo_user'] == 'Externo') echo 'selected'; ?>>Externo</option>
        </select>

        <label>Senha:</label>
        <input type="password" name="senha" value="<?php echo $row['senha']; ?>" required>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
