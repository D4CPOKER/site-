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
		$senha2 = $_POST['senha2'];

		$usuario_existente = false;
		$senhaigual = false;
		
		if ($senha == $senha2){
			$senhaigual = true;
		}else{
			$mensage = "Digite a mesma senha";
		}
		

		// Verifica se o nome de usuário já existe no arquivo
		if ((file_exists("usuario.txt")) && ($senhaigual)) {
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
				$_SESSION['usuario'] = $usuario;  
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
	<?php
// Array de meses para datalist e validação futura
$meses = [
    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
];

$anoAtual = date("Y");

// Função auxiliar para preservar valor digitado
function manterValor($campo) {
    return isset($_POST[$campo]) ? htmlspecialchars($_POST[$campo]) : '';
}
?>
	
	<!DOCTYPE html>
	<html lang="pt-BR">
	<head>
		<meta charset="UTF-8"> <!-- Suporte a acentuação -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade -->
		<title>Cadastro</title> <!-- Título da aba -->
		<link rel="stylesheet" href="css/c.css"> <!-- Estilos CSS -->
		<link rel="icon" type="image/png" href="img/caveira1.png">
		
	</head>

	<body class="corpo">
		<!-- Botão de voltar com imagem -->
		<video autoplay muted loop playsinline id="video-fundo">
  <source src="vid/fundo.mp4" type="video/mp4" />
  Seu navegador não suporta vídeo HTML5.
</video>

		<div class="form-login">
			<form method="POST">
			<a href="index.php" class="voltar">
				<p class="voltar">-</p>
			</a>
				<h1 class="titulo">Crie sua conta </h1>

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
					<input class="input" required type="password" name="senha2" />
					<label class="label" for="senha">Digite novamente sua senha</label>
					<?php echo $mensagem; ?>
				</div>

				<!-- Campos para data de nascimento -->
				<div class="datas">
<!-- Campo: Dia -->
<div class="input-group2">
    <input
        type="number"
        id="dia"
        name="dia"
        class="input"
        min="1"
        max="31"
        placeholder="Dia"
        required
        value="<?= manterValor('dia') ?>"
    >
    <label for="dia" class="label">Dia</label>
</div>

<!-- Campo: Mês com datalist -->
<div class="input-group2">
    <input
        type="text"
        id="mes"
        name="mes"
        class="input"
        list="listaMeses"
        placeholder="Mês"
        required
        value="<?= manterValor('mes') ?>"
    >
    <label for="mes" class="label">Mês</label>
    <datalist id="listaMeses">
        <?php foreach ($meses as $num => $nome): ?>
            <option value="<?= $nome ?>"><?= $nome ?></option>
        <?php endforeach; ?>
    </datalist>
</div>

<!-- Campo: Ano -->
<div class="input-group2">
    <input
        type="number"
        id="ano"
        name="ano"
        class="input"
        min="1900"
        max="<?= $anoAtual ?>"
        placeholder="Ano"
        required
        value="<?= manterValor('ano') ?>"
    >
    <label for="ano" class="label">Ano</label>
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


