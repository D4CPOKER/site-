<?php session_start();?> 
<!-- Inicia a sessão para poder verificar se o usuário está logado ou não -->
<!DOCTYPE html>
<html lang="pt-BR"> <!-- Define o idioma da página -->
<head>
  <meta charset="UTF-8"> <!-- Suporte a caracteres especiais -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade em dispositivos móveis -->
  <title>Menu</title> <!-- Título da aba -->
  <link rel="icon" type="image/png" href="img/caveira1.png">
   <source src="../vid/fundo.mp4" type="video/mp4" />

  <!-- Link para CSS externo (você precisa definir o nome do arquivo corretamente) -->
  <link rel="stylesheet" href="css/.css">

  <!-- Fonte do Google (Uncial Antiqua) -->

</head>

<body >
<video autoplay muted loop playsinline id="video-fundo">
  <source src="vid/fundo.mp4" type="video/mp4" />
  Seu navegador não suporta vídeo HTML5.
</video>
  <div class="Topo"> <!-- Cabeçalho principal -->
    <img class="img" src="img/logo_com_titulo.png" alt="Logo"> <!-- Logotipo no topo -->
<div class="menu">
  <!-- Itens principais do menu -->
  <nav class="menu-links">
    <a class="menu_item" href="#">HISTÓRIA</a>
    <a class="menu_item" href="#">COMO JOGAR</a>
    <a class="menu_item" href="#">INVENTÁRIO</a>
    <a class="menu_item" href="#">APOIE</a>
    <a class="menu_item" href="#">SUPORTE</a>
  </nav>
  </div>
      <?php if (empty($_SESSION['login_sucesso'])): ?>
        <!-- Caso o usuário NÃO esteja logado, mostra opções de login e cadastro -->
        <a class="menu_l" href="login.php"><div class="b">Login</div></a>
        <a class="menu_l" href="cadastro.php"><div class="b">Cadastre-se</div></a>

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
</body>
<footer>
  <div class="rodape"> <!-- Rodapé da página -->

    <p >
      <a href="#" class="link_rodape">Política de Privacidade</a> |
      <a href="#" class="link_rodape">Termos de Uso</a> |
      <a href="#"class="link_rodape">Contato</a>
    </p>
	<p>
      &copy; 2025 RPG Câmara da Caveira. Todos os direitos reservados por
      Davi Camillo, Matheus Marafon e Gabriel Zarpelon do Nascimento.
    </p>
  </div>
</footer>
</html>
