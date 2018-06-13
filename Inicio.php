<?php

  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: FLogin.php");
    exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/estilos.css">
	<title>Login</title>
</head>
<body>

		<!--Navegador-->
	<nav>
		<div class="navbar-nav">
			<a class="navbar-title" href="#">BOOKIFY </a>

        <span class="navbar-text-up">
          <a href="#" style=" color:green; text-decoration:none; padding-left: 55%;"><?php echo "<b>Usuario: </b>".$_SESSION['user_name']; ?></a>
        </span>
        <span class="navbar-text-up">
        <a href="FLogin.php?Logout" style="padding-left: 5%; text-decoration:none;">Salir</a>
      </span>
		</div>
	</nav>

  <div class="contenedor-menu">
     <ul class="menu">
          <li><a href="#"><img src="images/libro.png" width="200px" align="center"></a></li>
     	<li>
        <a href="#">Perfil</a></li>

     	<li>
        <a href="#">Mis Libros</a>

      </li>
      <li>
        <a href="#">Actualizar a Premium</a>

      </li>



  </div>

	<!--Footer-->
  <nav class="navbar-bottom">
    <div class="foot">
          <p class="navbar-text-down">&copy <?php echo date('Y-M-D');?> - Team
           <a href="#" target="_blank" style="color: green">Sitios Web y Sistemas</a>
          </p>
          <p class="navbar-text-down">Sistema de S.A. de C.V.</p>
          <hr>
          <h6 align="center" style="color: #A4A4A4;">Si haces clic en "Acceder con Facebook" y no eres usuario de Spotify, quedarás registrado y aceptarás los Términos y Condiciones y la Política de Privacidad de Bookify.</h6>
      </div>
  </nav>
</body>
</html>
