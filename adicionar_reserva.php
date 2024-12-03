<?php
session_start();

$id = $_SESSION['id'];

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alugel";

$con = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($con->connect_error) {
    die("Erro de conexão: " . $con->connect_error);
}

// Manipular o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_espaco = $_POST['id_espaco'];
    $data_reserva = $_POST['data_reserva'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $status_reserva = "pendente"; // Status inicial da reserva

    echo 'id_espaco';
    // Inserir os dados na tabela reserva
    $sql = "INSERT INTO reserva (id_espaco, data_reserva, hora_inicio, hora_fim, id_utilizador, status_reserva) 
            VALUES ('$id_espaco', '$data_reserva', '$hora_inicio', '$hora_fim', '$id', '$status_reserva')";

    if ($con->query($sql) === TRUE) {
        echo "Reserva adicionada com sucesso!";
        header("Location: logado.php");

    } else {
        echo "Erro ao adicionar reserva: " . $con->error;
    }
}

// Buscar os espaços com JOIN
$sql_espacos = "
    SELECT e.id_espaco, e.nome 
    FROM espaco AS e
";
$result_espacos = $con->query($sql_espacos);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Adicionar Reserva</title>
</head>
<body>
    <h1>Adicionar Reserva</h1>
    <form method="POST" action="">
        <div class="form-container">
        <label for="id_espaco">Espaço:</label>
        <select name="id_espaco" id="id_espaco" required>
            <option value="">Selecione um espaço</option>
            <?php
            if ($result_espacos->num_rows > 0) {
                while ($row = $result_espacos->fetch_assoc()) {
                    echo "<option value='" . $row['id_espaco'] . "'>" . $row['nome'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum espaço disponível</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="data_reserva">Data da Reserva:</label>
        <input type="date" name="data_reserva" id="data_reserva" required>
        <br><br>

        <label for="hora_inicio">Hora de Início:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" required>
        <br><br>

        <label for="hora_fim">Hora de Fim:</label>
        <input type="time" name="hora_fim" id="hora_fim" required>
        <br><br>

        <button type="submit">Adicionar Reserva</button>
    </form>
        </div>
    <h2>Reservas Existentes (com informações do espaço)</h2>
</body>
</html>

<?php
$con->close();
?>
