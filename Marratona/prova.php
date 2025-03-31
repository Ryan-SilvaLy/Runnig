<?php
// Inicializar as variáveis de erro
$nomeError = $emailError = $cpfError = $idadeError = $condicionamentoError = $tenisError = $inscricaoError = "";
$resultado = "";
$messageClass = "success";  // Definindo classe de sucesso como padrão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $condicionamento_fisico = $_POST['condicionamento_fisico'];
    $tenis_corrida = $_POST['tenis_corrida'];
    $inscricao = isset($_POST['inscricao']) ? true : false;
    $idade = $_POST['idade'];

    // Validação do nome
    if (strlen($nome) > 30 || strlen($nome) < 15) {
        $nomeError = "O nome deve ter entre 15 e 30 caracteres.";
    }

    // Validação do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Por favor, insira um email válido.";
    }

    // Validação do CPF
    $cpfRegex = "/^\d{3}\.\d{3}\.\d{3}-\d{2}$/";
    if (!preg_match($cpfRegex, $cpf)) {
        $cpfError = "Por favor, insira um CPF válido.";
    }

    // Validação da idade
    if ($idade < 18 || $idade > 50) {
        $idadeError = "A idade deve ser entre 18 e 50 anos.";
    }

    // Verificação de sucesso (se não houver erros)
    if ($nomeError || $emailError || $cpfError || $idadeError) {
        $resultado = "Há erros no formulário. Corrija os campos destacados.";
        $messageClass = "error";  // Define a classe de erro para a mensagem
    } else {
        $resultado = "Requisitos atendidos!";
        $messageClass = "success";  // Caso o formulário seja válido
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Requisitos</title>
    <link rel="stylesheet" href="static/prova.css"> <!-- Importando o arquivo CSS -->
    <script>
        // Função para esconder a mensagem de sucesso/erro após 4 segundos
        function hideMessage() {
            setTimeout(function() {
                const message = document.getElementById("message");
                if (message) {
                    message.style.display = "none"; // Esconde a mensagem após 4 segundos
                }
            }, 3000); // A mensagem desaparece após 4 segundos
        }
    </script>
</head>
<body>
    <h1>Verifique se você pode participar da prova</h1>

    <!-- Formulário para enviar os requisitos -->
    <form action="prova.php" method="POST">
        <label for="nome">Qual é seu nome?</label>
        <input type="text" name="nome" id="nome" value="<?php echo isset($nome) ? $nome : ''; ?>">
        <span class="error"><?php echo $nomeError; ?></span> <!-- Exibe o erro se houver -->

        <label for="email">Digite seu email</label>
        <input type="email" name="email" id="id_email" value="<?php echo isset($email) ? $email : ''; ?>">
        <span class="error"><?php echo $emailError; ?></span> <!-- Exibe o erro se houver -->

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required placeholder="000.000.000-00" maxlength="14" value="<?php echo isset($cpf) ? $cpf : ''; ?>" />
        <span class="error"><?php echo $cpfError; ?></span> <!-- Exibe o erro se houver -->

        <label for="condicionamento_fisico">Qual seu condicionamento físico?</label>
        <select name="condicionamento_fisico" required>
            <option value="bom" <?php echo (isset($condicionamento_fisico) && $condicionamento_fisico == 'bom') ? 'selected' : ''; ?>>Bom</option>
            <option value="médio" <?php echo (isset($condicionamento_fisico) && $condicionamento_fisico == 'médio') ? 'selected' : ''; ?>>Médio</option>
            <option value="ruim" <?php echo (isset($condicionamento_fisico) && $condicionamento_fisico == 'ruim') ? 'selected' : ''; ?>>Ruim</option>
        </select>
        <span class="error"><?php echo $condicionamentoError; ?></span> <!-- Exibe o erro se houver -->

        <label for="tenis_corrida">Qual seu tênis?</label>
        <select name="tenis_corrida" required>
            <option value="bom" <?php echo (isset($tenis_corrida) && $tenis_corrida == 'bom') ? 'selected' : ''; ?>>Corre max</option>
            <option value="bom" <?php echo (isset($tenis_corrida) && $tenis_corrida == 'bom') ? 'selected' : ''; ?>>Corre 3</option>
            <option value="bom" <?php echo (isset($tenis_corrida) && $tenis_corrida == 'bom') ? 'selected' : ''; ?>>Corre 4</option>
        </select>
        <span class="error"><?php echo $tenisError; ?></span> <!-- Exibe o erro se houver -->

        <label for="inscricao">Você já se inscreveu para a prova?</label>
        <input type="checkbox" name="inscricao" <?php echo (isset($inscricao) && $inscricao) ? 'checked' : ''; ?>>
        <span class="error"><?php echo $inscricaoError; ?></span> <!-- Exibe o erro se houver -->

        <label for="idade">Qual sua idade?</label>
        <input type="number" name="idade" required min="0" value="<?php echo isset($idade) ? $idade : ''; ?>">
        <span class="error"><?php echo $idadeError; ?></span> <!-- Exibe o erro se houver -->

        <input type="submit" value="Verificar Requisitos">
    </form>

    <!-- Exibe a mensagem de erro ou sucesso -->
    <?php
    if ($resultado != "") {
        echo "<div id='message' class='$messageClass'>$resultado</div>";
        echo "<script>hideMessage();</script>"; // Chama a função JavaScript para esconder a mensagem após 4 segundos
    }
    ?>
</body>
</html>
