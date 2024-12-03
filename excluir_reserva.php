<?php
include('connect.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    echo "Erro: Utilizador não está logado.";
    exit;
}

// Verifica se a reserva foi passada como parâmetro
if (isset($_GET['id_reserva']) && is_numeric($_GET['id_reserva'])) {
    $id_reserva = intval($_GET['id_reserva']);
    
    // Verificar se a reserva está "Pendente"
    $sql = "SELECT status_reserva FROM reserva WHERE id_reserva = ? AND status_reserva = 'Pendente'";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_reserva);
    $stmt->execute();
    $stmt->store_result();
    
    // Se a reserva for "Pendente", proceder com a exclusão
    if ($stmt->num_rows > 0) {
        $sql_delete = "DELETE FROM reserva WHERE id_reserva = ?";
        $stmt_delete = $con->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id_reserva);
        $stmt_delete->execute();

        if ($stmt_delete->affected_rows > 0) {
            header("Location: logado.php"); // Redireciona de volta para a página de reservas
            exit;
        } else {
            echo "Erro ao excluir a reserva.";
        }
    } else {
        echo "Reserva não encontrada ou não é pendente.";
    }
} else {
    echo "ID inválido.";
}
?>
