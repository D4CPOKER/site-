<?php session_start();?> 
<!-- Inicia a sessão para poder verificar se o usuário está logado ou não -->
<!DOCTYPE html>
<html lang="pt-BR"> <!-- Define o idioma da página -->
<head>
  <meta charset="UTF-8"> <!-- Suporte a caracteres especiais -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade em dispositivos móveis -->
  <title>Menu</title> <!-- Título da aba -->

  <!-- Link para CSS externo (você precisa definir o nome do arquivo corretamente) -->
  <link rel="stylesheet" href="css/.css">

  <!-- Fonte do Google (Uncial Antiqua) -->
  <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
</head>

<body style="background:img/123.jfif;">
  <div class="Topo"> <!-- Cabeçalho principal -->
    <img class="img" src="img/l.png" alt="Logo"> <!-- Logotipo no topo -->
<div class="menu">
  <!-- Itens principais do menu -->
  <nav class="menu-links">
    <a class="menu_item" href="historia.php">HISTÓRIA</a>
    <a class="menu_item" href="jogar.php">COMO JOGAR</a>
    <a class="menu_item" href="inventario.php">INVENTÁRIO</a>
    <a class="menu_item" href="apoie.php">APOIE</a>
    <a class="menu_item" href="suporte.php">SUPORTE</a>
  </nav>
      <?php if (empty($_SESSION['login_sucesso'])): ?>
        <!-- Caso o usuário NÃO esteja logado, mostra opções de login e cadastro -->
        <a class="menu_l" href="login.php"><div class="b">Login</div></a>
        <a class="menu_l" href="cadastro.php"><div class="b">Cadastrar</div></a>

      <?php else: ?>
<div class="login-wrapper">
  <div class="b5">
    <span><?php echo $_SESSION['usuario']; ?></span>
    <img src="img/123.jpeg" alt="Avatar" class="avatar">
  </div>
  <div class="dropdown-menu">
    <a href="#" class="menu_item">Perfil</a>
    <a href="#" class="menu_item">Configurações</a>
    <a href="logout.php" class="menu_item">Sair</a>
  </div>
</div>

      <?php endif; ?>
    </div> <!-- Fecha o .menu -->
  </div> <!-- Fecha o .Topo -->

  <div class="corpo"> <!-- Área principal da página -->
    <!-- Conteúdo do site pode ser inserido aqui -->
  </div>
  <div class="rodape"> <!-- Rodapé da página -->

    <p>
      <a href="#">Política de Privacidade</a> |
      <a href="#">Termos de Uso</a> |
      <a href="#">Contato</a>
    </p>
	<p>
      &copy; 2025 RPG Câmara da Caveira. Todos os direitos reservados por
      Davi Camillo, Matheus Marafon e Gabriel Zarpelon do Nascimento.
    </p>
  </div>
</body>
</html>
