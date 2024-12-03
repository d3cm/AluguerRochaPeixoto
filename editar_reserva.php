<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa o formulário enviado
    $id_reserva = $_POST['id_reserva'];
    $data_reserva = $_POST['data_reserva'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $status_reserva = $_POST['status_reserva'];
    $id_utilizador = $_POST['id_utilizador'];
    $id_espaco = $_POST['id_espaco'];

    // Atualiza os dados da reserva no banco de dados
    $sql = "UPDATE reserva 
            SET data_reserva = '$data_reserva', 
                hora_inicio = '$hora_inicio', 
                hora_fim = '$hora_fim', 
                status_reserva = '$status_reserva', 
                id_utilizador = $id_utilizador, 
                id_espaco = $id_espaco 
            WHERE id_reserva = $id_reserva";

    if ($con->query($sql) === TRUE) {
        echo "Reserva atualizada com sucesso.";
        header("Location: index.php"); // Redireciona para a página inicial
        exit();
    } else {
        echo "Erro ao atualizar a reserva: " . $con->error;
    }

    $con->close();
} else {
    // Obtém os dados da reserva para edição
    $id_reserva = $_GET['id_reserva'];
    $sql = "SELECT * FROM reserva WHERE id_reserva = $id_reserva";
    $result = $con->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
</head>

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
</header>
<body>
    <h1>Editar Reserva</h1>
    <form method="POST" action="">
        <div class="form-container">
        <input type="hidden" name="id_reserva" value="<?php ($row['id_reserva']); ?>">
        
        <label for="data_reserva">Data da Reserva:</label>
        <input type="date" id="data_reserva" name="data_reserva" value="<?php echo htmlspecialchars($row['data_reserva']); ?>" required><br>

        <label for="hora_inicio">Hora de Início:</label>
        <input type="time" id="hora_inicio" name="hora_inicio" value="<?php echo htmlspecialchars($row['hora_inicio']); ?>" required><br>

        <label for="hora_fim">Hora de Fim:</label>
        <input type="time" id="hora_fim" name="hora_fim" value="<?php echo htmlspecialchars($row['hora_fim']); ?>" required><br>

        <button type="submit">Atualizar</button>
        </div>
    </form>
</body>
</html>
