<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doces_da_vovo";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$erro = ""; // Variável para armazenar mensagens de erro
$sucesso = ""; // Variável para armazenar mensagem de sucesso

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Inserção no banco de dados sem validação ou preparação
    $sql = "INSERT INTO tb_formulario (nome, email, mensagem) VALUES ('$nome', '$email', '$mensagem')";

    // Verifica se a inserção foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        $sucesso = "Dados enviados com sucesso!";
    } else {
        $erro = "Erro ao enviar os dados: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloPaginas.css">
    <title>Doces da Vovó</title>
</head>

<body>
    <!-- formulario de contato -->
    <section class="conteudo_flexivel">
        <!-- Mensagem de validação do js -->
        <p id="erro-msg" class="erro" style="display:none;"></p>
        
        <form action="index.php" method="POST" id="formContato">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" minlength="3">

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required>

            <label for="mensagem">Mensagem</label>
            <textarea name="mensagem" id="mensagem" cols="4" rows="5" required minlength="20"></textarea>

            <button type="submit" id="enviarDados" class="botao-padrao">Enviar</button>
        </form>
    </section>
    <!-- Retorno dos dados com php -->
    <section class="conteudo_flexivel">
        <?php
        // Exibe os dados enviados após o envio do formulário
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($sucesso)) {
            echo "<div class='dados-enviados'>";
            echo "<h2 class='titulo'>Dados Enviados:</h2>";
            echo "<p><strong>Nome:</strong> $nome</p>";
            echo "<p><strong>E-mail:</strong> $email</p>";
            echo "<p><strong>Mensagem:</strong> $mensagem</p>";
            echo "<button class='botao-padrao' onclick='fecharDados()'>Fechar</button>";
            echo "</div>";
        } else if (isset($erro)) {
            echo "<p class='erro'>$erro</p>";
        }
        ?>
    </section>


    <script src="/form/js/validar.js"></script>
</body>

</html>