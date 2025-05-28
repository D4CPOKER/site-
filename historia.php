<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>

  <!-- CSS Externo -->
  <link rel="stylesheet" href="css/h.css">

  <!-- Fonte Google -->
  <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
</head>

<body>

  <!-- TOPO -->
  <div class="Topo">
    <img class="img" src="img/h.png" alt="Logo">

    <div class="menu">
      <a class="menu_item" href="index.php">INICIO</a>
      <a class="menu_item" href="jogar.php">COMO JOGAR</a>
      <a class="menu_item" href="inventario.php">INVENTÁRIO</a>
      <a class="menu_item" href="apoie.php">APOIE</a>
      <a class="menu_item" href="suporte.php">SUPORTE</a>

      <?php if (empty($_SESSION['login_sucesso'])): ?>
        <div class="b"><a class="menu_l" href="login.php">Login</a></div>
        <div class="b"><a class="menu_l" href="cadastro.php">Cadastrar</a></div>
      <?php else: ?>
        <!-- Avatar e Dropdown -->
        <div class="login-wrapper">
          <img src="img/123.jpeg" alt="Avatar" class="avatar">
          <div class="dropdown-menu">
            <a href="#" class="menu_item">Perfil</a>
            <a href="#" class="menu_item">Configurações</a>
            <a href="logout.php" class="menu_item">Sair</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="corpo">
  </div>

  <!-- RODAPÉ -->
  <div class="rodape">
    <p>&copy; 2025 RPG Câmara da Caveira. Todos os direitos reservados por Davi Camillo, Matheus Marafon e Gabriel Zarpelon do Nascimento.</p>
    <p>
      <a href="#">Política de Privacidade</a> |
      <a href="#">Termos de Uso</a> |
      <a href="#">Contato</a>
    </p>
  </div>

</body>
</html>
