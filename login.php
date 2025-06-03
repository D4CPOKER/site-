<?php
session_start();

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario && $senha) {
        $linhas = file("usuario.txt");
        $login_sucesso = false;

        foreach ($linhas as $linha) {
            $linha = trim($linha);
            $dados = explode(";", $linha);

            if (count($dados) >= 4) {
                $email = $dados[0];
                $nome = $dados[1];
                $user = $dados[2];
                $senha_salva = $dados[3];

                if ($usuario === $user && password_verify($senha, $senha_salva)) {
                    $_SESSION['login_sucesso'] = true;
                    $_SESSION['usuario'] = $user;
                    $login_sucesso = true;
                    break;
                }
            }
        }

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
    <link rel="icon" type="image/png" href="img/caveira1.png">
</head>
<body class="corpo">
<video autoplay muted loop playsinline id="video-fundo">
  <source src="vid/fundo.mp4" type="video/mp4" />
  Seu navegador não suporta vídeo HTML5.
</video>

    <div class="form-login">
				<a href="index.php" class="voltar">
				<p class="voltar">-</p>
			</a>
        <h3 class="titulo">Seja bem-vindo de volta!</h3>
        <h4 class="sub-tit">Estamos muito animados em ver você novamente!</h4>

        <form method="POST" class="formulario">
            <div class="input-group">
                <input class="input" id="username" required type="text" name="username" />
                <label class="label" for="username">Username</label>
            </div>

            <div class="input-group">
                <input class="input" id="senha" required type="password" name="senha" />
                <label class="label" for="senha">Senha</label>
            </div>

            <button type="submit" class="botao">Enviar</button>
        </form>

        <?= $mensagem ?>

        <label class="frase">Não possui conta? <a href="cadastro.php">Registrar-se agora</a></label>
    </div>

</body>
</html>
