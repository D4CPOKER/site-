<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/.css"> <!-- Link para o arquivo CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">

    <title>Menu</title>
</head>
<body class="body_principal" style="background-image: url('img/a.png');">

    <!-- TOPO FIXO NO TOPO DA TELA -->
    <div class="Topo">
        <img class="img" src="img/l.png" alt="Logo">
        
        <!-- MENU DE NAVEGAÇÃO -->
        <div class="menu">
            <a class="menu_item" href="login.php">HISTORIA</a>
            <a class="menu_item" href="login.php">COMO JOGAR</a>
            <a class="menu_item" href="login.php">CURIOSIDADES</a>
            <a class="menu_item" href="login.php">INVENTARIO</a>
            <a class="menu_item" href="login.php">APOIE</a>
        </div>

        <!-- AVATAR (ADICIONADO DE VOLTA) -->
        <div class="login-wrapper">
            <input type="checkbox" id="toggle-menu" class="toggle-menu">
            <label for="toggle-menu" class="avatar-label">
                <img src="img/b.png" alt="Avatar" class="avatar">
            </label>
            <div class="dropdown-menu">
                <a class="menu_item" href="login.php">Login</a>
				<a class="menu_item" href="cadastro.php">Cadastar</a>
            </div>
        </div>
    </div>

    <!-- CORPO PRINCIPAL COM 3 COLUNAS -->
    <div class="corpo">
        <div class="centro">
            <!-- Conteúdo central -->
            a <!-- Conteúdo de teste -->
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer class="rodape">
        <p>&copy; 2025 RPG Camara da Caveira. Todos os direitos reservados.</p>
        <p>
            <a href="#">Política de Privacidade</a> | 
            <a href="#">Termos de Uso</a> | 
            <a href="#">Contato</a>
        </p>
    </footer>
</body>
</html>
