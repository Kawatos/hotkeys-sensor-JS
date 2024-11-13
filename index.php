<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detecção de Teclas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .log {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            max-height: 200px;
            overflow-y: auto;
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Detecção de Teclas Pressionadas - Usuário 1</h1>
    <p>Pressione qualquer tecla para registrar o comando:</p>
    <div class="log" id="log"></div>
    <button onclick="salvarComando()">Salvar Comando e Ir para Usuário 2</button>

    <script>
        let teclasSendoPressionadas = [];
        redefinindo = false;

        document.addEventListener('keydown', (event) => {
            if (redefinindo === true) {
                teclasSendoPressionadas = []; // Não usar `let` aqui, pois queremos redefinir a variável global.
            }

            if (!teclasSendoPressionadas.includes(event.key)) {
                teclasSendoPressionadas.push(event.key);
            }

            let logDiv = document.getElementById('log');
            logDiv.textContent = `Teclas sendo pressionadas: ${teclasSendoPressionadas.join(', ')}`;
            redefinindo = false;
        });

        document.addEventListener('keyup', (event) => {
            redefinindo = true;
            teclasPressionadas = teclasSendoPressionadas;
        });

        function salvarComando() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'salvar_comando.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Comando salvo com sucesso!');
                    window.location.href = 'usuario2.php';
                }
            };
            xhr.send('comando=' + encodeURIComponent(teclasPressionadas.join('')));
        }
    </script>
</body>
</html>
