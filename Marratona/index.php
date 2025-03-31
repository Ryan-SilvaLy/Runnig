<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Requisitos</title>
    <link rel="stylesheet" href="static/prova.css"> <!-- Importando o arquivo CSS -->
</head>
<body>
    <h1>Verifique se você pode participar da prova</h1>

    <!-- Formulário para enviar os requisitos -->
    <form action="prova.php" method="POST">
    <label for="nome">Qual é seu nome?</label>
    <input type="text" name="nome" id="nome">
    <span class="error"><?php echo $nomeError; ?></span> <!-- Exibe o erro se houver -->

    <label for="email">Digite seu email</label>
    <input type="email" name="email" id="id_email">
    <span class="error"><?php echo $emailError; ?></span> <!-- Exibe o erro se houver -->

    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" id="cpf" required placeholder="000.000.000-00" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
    <span class="error"><?php echo $cpfError; ?></span> <!-- Exibe o erro se houver -->

    <label for="condicionamento_fisico">Qual seu condicionamento físico?</label>
    <select name="condicionamento_fisico" required>
        <option value="bom">Bom</option>
        <option value="médio">Médio</option>
        <option value="ruim">Ruim</option>
    </select>
    <span class="error"><?php echo $condicionamentoError; ?></span> <!-- Exibe o erro se houver -->

    <label for="tenis_corrida">Qual seu tenis?</label>
    <select name="tenis_corrida" required>
        <option value="bom">Corre max</option>
        <option value="bom">Corre 3</option>
        <option value="bom">Corre 4</option>
    </select>
    <span class="error"><?php echo $tenisError; ?></span> <!-- Exibe o erro se houver -->

    <label for="inscricao">Você já se inscreveu para a prova?</label>
    <input type="checkbox" name="inscricao">
    <span class="error"><?php echo $inscricaoError; ?></span> <!-- Exibe o erro se houver -->

    <label for="idade">Qual sua idade?</label>
    <input type="number" name="idade" required min="0">
    <span class="error"><?php echo $idadeError; ?></span> <!-- Exibe o erro se houver -->

    <input type="submit" value="Verificar Requisitos">
</form>

</body>
</html>
