<?php
session_start(); // Inicia a sessão para usar variáveis de sessão

$mensagem = ""; // Mensagem de erro ou sucesso
$login_sucesso = false; // Flag de controle

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura e limpa os dados do formulário
    $email = trim($_POST['email']);
    $username = trim($_POST['name']);
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];

    $usuario_existente = false;

    // Verifica se o nome de usuário já existe no arquivo
    if (file_exists("usuario.txt")) {
        $linhas = file("usuario.txt"); // Lê todas as linhas do arquivo
        foreach ($linhas as $linha) {
            $dados = explode(";", trim($linha)); // Divide os dados da linha por ";"
            if (count($dados) >= 3 && $dados[2] == $usuario) {
                $usuario_existente = true;
                $mensagem = "<label style='color:red; font-size:16px;'>Nome de usuário já está em uso.</label>";
                break;
            }
        }
    }

    // Se o usuário ainda não existir
    if (!$usuario_existente) {
        // Verifica se todos os campos estão preenchidos
        if (!$email || !$username || !$usuario || !$senha || !$mes || !$dia || !$ano) {
            $mensagem = "<label style='color:red; font-size:20px;'>Por favor, preencha todos os campos.</label>";
        } else {
            // Formata a data de nascimento
            $dataNascimento = "$dia/$mes/$ano";

            // Cria o hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Monta a linha para salvar
            $linha = "$email;$username;$usuario;$senha_hash;$dataNascimento\n";

            // Abre o arquivo para escrita (modo append)
            $arquivo = fopen('usuario.txt', 'a');
            fwrite($arquivo, $linha); // Escreve a linha no arquivo
            fclose($arquivo); // Fecha o arquivo

            // Marca login como bem-sucedido
            $_SESSION['login_sucesso'] = true;
			$_SESSION['usuario'] = $user;  
            $login_sucesso = true;
        }
    }

    // Redireciona para a página inicial em caso de sucesso
    if ($login_sucesso) {
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"> <!-- Suporte a acentuação -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade -->
    <title>Cadastro</title> <!-- Título da aba -->
    <link rel="stylesheet" href="css/c.css"> <!-- Estilos CSS -->
</head>

<body class="corpo">
    <!-- Botão de voltar com imagem -->
    <a href="index.php" class="voltar"><img class="img" src="img/l.png" alt="Logo"></a>

    <div class="form-login">
        <form method="POST">
            <h1 class="titulo">Crie sua conta ≧◠‿◠≦✌</h1>

            <!-- Campo de e-mail -->
            <div class="input-group">
                <input class="input" required type="email" name="email" />
                <label class="label" for="email">E-mail</label>
            </div>

            <!-- Campo de nome exibido -->
            <div class="input-group">
                <input class="input" required type="text" name="name" />
                <label class="label" for="name">Nome Exibido</label>
            </div>

            <!-- Campo de nome de usuário -->
            <div class="input-group">
                <input class="input" required type="text" name="usuario" />
                <label class="label" for="usuario">Usuário</label>
            </div>

            <!-- Campo de senha -->
            <div class="input-group">
                <input class="input" required type="password" name="senha" />
                <label class="label" for="senha">Senha</label>
            </div>
			<div class="input-group">
                <input class="input" required type="password" name="Digite sua senha novamente" />
                <label class="label" for="senha">Senha</label>
            </div>

            <!-- Campos para data de nascimento -->
            <div class="datas">
                <!-- Dia -->
                <div class="input-group2">
                    <select name="dia" class="input" required>
                        <option value="" disabled selected hidden></option>
                        <script>
                            for (let i = 1; i <= 31; i++) {
                                document.write(`<option value="${i}">${i}</option>`);
                            }
                        </script>
                    </select>
                    <label class="label">Dia</label>
                </div>

                <!-- Mês -->
                <div class="input-group2">
                    <select name="mes" class="input" required>
                        <option value="" disabled selected hidden></option>
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                    <label class="label">Mês</label>
                </div>

                <!-- Ano -->
                <div class="input-group2">
                    <select name="ano" class="input" required>
                        <option value="" disabled selected hidden></option>
                            <?php
								$anoAtual = date("Y");
								for ($i = $anoAtual; $i >= 1900; $i--) {
								echo "<option value=\"$i\">$i</option>";
								}
							?>
                    </select>
                    <label class="label">Ano</label>
                </div>
            </div>
			

        <!-- Botão de envio -->
        <button type="submit" value="Entrar" class="botao">Continuar</button>
    </form>
		<?php if (!empty($mensagem)) echo "<div class='mensagem'>$mensagem</div>"; ?>

    <!-- Links de termos -->
    <p class="frase">
        Ao se registrar no site, você concorda com os
        <a href="termos.html" target="_blank" rel="noopener noreferrer">Termos de Serviço</a> e a
        <a href="privacidade.html" target="_blank" rel="noopener noreferrer">Política de Privacidade</a>
        do CDC.
    </p>

    <!-- Link para login -->
    <p class="login-link">
        Já tem conta? <a href="login.php">Entrar</a>
    </p>
</div>

</body>
</html>


