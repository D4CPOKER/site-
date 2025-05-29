<?php
session_start(); // Inicia a sessão para guardar dados do usuário logado

$mensagem = ""; // Variável usada para exibir mensagens de erro

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário (username e senha), usando operador null coalescing (??) para evitar erros
    $usuario = $_POST['username'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Verifica se os campos não estão vazios
    if ($usuario && $senha) {
        $linhas = file("usuario.txt"); // Lê todas as linhas do arquivo de usuários
        $login_sucesso = false; // Flag para controlar se o login foi bem-sucedido

        // Percorre cada linha do arquivo
        foreach ($linhas as $linha) {
            $linha = trim($linha); // Remove espaços em branco e quebras de linha
            $dados = explode(";", $linha); // Divide a linha em partes separadas por ";"

            // Verifica se a linha tem ao menos 4 elementos (email, nome, username, senha)
            if (count($dados) >= 4) {
                $email = $dados[0];
                $nome = $dados[1];
                $user = $dados[2];
                $senha_salva = $dados[3]; // Senha armazenada (criptografada)

                // Verifica se o username bate e se a senha informada confere com a salva (usando password_verify)
                if ($usuario === $user && password_verify($senha, $senha_salva)) {
                    $_SESSION['login_sucesso'] = true; // Define flag de login na sessão
                    $_SESSION['usuario'] = $user;      // Salva nome de usuário na sessão (opcional)
                    $login_sucesso = true;
                    break; // Sai do loop pois já encontrou o usuário
                }
            }
        }

        // Redireciona para a página inicial se o login foi bem-sucedido
        if ($login_sucesso) {
            header("Location: index.php");
            exit();
        } else {
            $mensagem = "<p style='color: red;'>Usuário ou senha incorretos!</p>";
        }
    } else {
        $mensagem = "<p style='color: red;'>Preencha todos os campos!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Título da Página</title>
    <link rel="stylesheet" href="css/l.css" />
	<link rel="icon" type="image/png" href="img/l.png">
	
</head>
<body class="corpo">
    <!-- Botão para voltar à página inicial -->
    <a href="index.php" class="voltar">
        <img class="img" src="img/l.png" alt="Logo" />
    </a>

    <div class="fund">
        <h3 class="titulo">Seja bem-vindo de volta!</h3>
        <h4 class="sub_tit">Estamos muito animados em ver você novamente!</h4>

        <!-- Formulário de login -->
        <form method="POST" class="formulario">
            <!-- Campo de username -->
            <div class="input-group">
                <input class="input" id="username" required type="text" name="username" />
                <label class="label" for="username">Username</label>
            </div>

            <!-- Campo de senha -->
            <div class="input-group">
                <input class="input" id="senha" required type="password" name="senha" />
                <label class="label" for="senha">Senha</label>
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="botao">Enviar</button>
        </form>

        <!-- Exibição de mensagem de erro (caso exista) -->
        <?= $mensagem ?>

        <!-- Link para registro -->
        <label class="frase">Não possui conta? <a href="cadastro.php"> Registrar-se agora</a></label>
    </div>

</body>
</html>
