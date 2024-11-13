<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotkeys";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['comando'])) {
    $comando = $conn->real_escape_string($_POST['comando']);

    // Apagar o último comando inserido (ou o comando mais recente)
    $sqlDelete = "DELETE FROM comandos ORDER BY id DESC LIMIT 1";
    if ($conn->query($sqlDelete) === TRUE) {
        // Inserir o novo comando
        $sqlInsert = "INSERT INTO comandos (comando) VALUES ('$comando')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Comando salvo com sucesso!";
        } else {
            echo "Erro ao salvar comando: " . $conn->error;
        }
    } else {
        echo "Erro ao apagar comando anterior: " . $conn->error;
    }
}

$conn->close();
?>
