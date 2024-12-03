<?php
include('connect.php');
session_start();

if (!isset($_SESSION['id'])) {
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $_SESSION['id'] = intval($_GET["id"]);
    } else {
        echo "Erro: Utilizador não está logado.";
        exit;
    }
}

$id = $_SESSION['id'];

$sql = "SELECT r.id_reserva, r.data_reserva, r.hora_inicio, r.hora_fim, r.status_reserva, 
               u.nome AS nome_utilizador, u.email, u.telefone
        FROM reserva r
        JOIN utilizador u ON r.id_utilizador = u.id_utilizador
        WHERE u.id_utilizador = ?";

$stmt = $con->prepare($sql);
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $con->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguer de Espaços</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function confirmarLogout(event) {
            event.preventDefault();
            let confirmar = confirm('Tem certeza que deseja sair?');

            if (confirmar) {
                window.location.href = 'logout.php';
            } else {
                return false;
            }
        }
    </script>
</head>

<body>
    <header>
        <h1>Aluguer de Espaços da Rocha</h1>
        <a href="logout.php" class="login-button" onclick="return confirmarLogout(event)">Logout</a>
    </header>

    <main>
        <h2>Reservas do Utilizador</h2>
        <table border="1">
            <tr>
                <th>Data</th>
                <th>Hora Início</th>
                <th>Hora Fim</th>
                <th>Status</th>
                <th>Nome Utilizador</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
                <th>Ações</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                echo "<p>Foram encontrados (" . $result->num_rows . ") resultado(s).</p>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['data_reserva']}</td>
                        <td>{$row['hora_inicio']}</td>
                        <td>{$row['hora_fim']}</td>
                        <td>{$row['status_reserva']}</td>
                        <td>{$row['nome_utilizador']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telefone']}</td>
                        <td>";
                    
                    // Exibe o botão "Editar" se o status da reserva não for "Confirmada" ou "Cancelada"
                    if ($row['status_reserva'] != 'Confirmada' && $row['status_reserva'] != 'Cancelada') {
                        echo "<a href='editar_perfil.php?id_reserva={$row['id_reserva']}'>Editar</a>";
                    } else {
                        echo "Edição não permitida";
                    }
                    
                    echo "</td><td>";
                    
                    // Exibe o botão "Excluir" se o status da reserva não for "Confirmada" ou "Cancelada"
                    if ($row['status_reserva'] != 'Confirmada' && $row['status_reserva'] != 'Cancelada') {
                        echo "<a href='excluir_reserva.php?id_reserva={$row['id_reserva']}'>Excluir</a>";
                    } else {
                        echo "Exclusão não permitida";
                    }
            
                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhuma reserva encontrada para este utilizador.</td></tr>";
            }
            ?>
        </table>
        <div class="form-container">
            <a href="adicionar_reserva.php" class="btn-adicionar">Adicionar Nova Reserva</a>
        </div>

    </main>

    <footer>
        <p>&copy; 2024 Nosso Site. Todos os direitos reservados.</p>
        <p><a href="#">Política de Privacidade</a> | <a href="#">Termos de Uso</a></p>
    </footer>
</body>

</html>
