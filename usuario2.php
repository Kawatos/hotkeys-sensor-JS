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

// Busca o último comando salvo
$sql = "SELECT comando FROM comandos ORDER BY id DESC LIMIT 1"; // Certifique-se de que a tabela tenha uma coluna 'id' auto-incrementada
$result = $conn->query($sql);

$comandoSalvo = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $comandoSalvo = $row['comando'];
} else {
    echo "Nenhum comando encontrado.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Comando - Usuário 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        #mensagem {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Verificação de Comando - Usuário 2</h1>
    <p>Pressione as teclas conforme o comando exibido abaixo:</p>
    <div id="comando"><?php echo htmlspecialchars($comandoSalvo); ?></div>
    <p id="mensagem"></p>

    <script>
        const comandoSalvo = "<?php echo addslashes($comandoSalvo); ?>";
        let teclasPressionadas = []; // Declare o array fora do evento para garantir que ele seja compartilhado entre os eventos.

        document.addEventListener('keydown', (event) => {
            // Captura a tecla pressionada
            teclasPressionadas.push(event.key);
            
            // Exibe as teclas pressionadas até agora
            const mensagem = document.getElementById('mensagem');
            const teclasAtualizadas = teclasPressionadas.join('');
            
            // Verifica se as teclas pressionadas até agora correspondem ao comando salvo
            if (teclasAtualizadas === comandoSalvo) {
                mensagem.textContent = "Parabéns! Comando digitado corretamente!";
                mensagem.style.color = 'green';
            } else {
                mensagem.textContent = "Comando incorreto, continue pressionando as teclas.";
                mensagem.style.color = 'red';
            }
        });

        document.addEventListener('keyup', (event) => {
            // Limpa as teclas pressionadas ao liberar qualquer tecla
            teclasPressionadas = [];
        });

        
    </script>
</body>
</html>
