<?php

// include the configs /  database connection
require_once("config/db.php");

// load the login class
require_once("sesiones/PLogin.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   header("location: Inicio.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
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
		<div class="fondo"></div>
		<!--Nav-->
	<nav>
		<div class="navbar-top">
			<a class="navbar-title" href="#">BOOKIFY</a>
		</div>
	</nav>

	<?php
				// MUESTRA LOSS ERRORES GENERADOS EN EL LOGIN
				if (isset($login)) {
					if ($login->errors) {
						?>
						<script src="jquery/jquery-3.3.1.min.js"></script>

						<div class="alerta" >
						    <strong>Error!</strong>

						<?php
							foreach ($login->errors as $error) {
								echo $error;
							}
						?>
							</div>
							<script>
								$(document).ready(function() {
									setTimeout(function() {
											$(".alerta").fadeOut(1500);
									},1000);
								});
						 </script>
						<?php
					}//FIN DE SSESION
					if ($login->messages) {
						?>
						<script src="jquery/jquery-3.3.1.min.js"></script>
						<div class="alertaLogout">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div>
						<script>
							$(document).ready(function() {
								setTimeout(function() {
										$(".alertaLogout").fadeOut(1500);
								},1000);
							});
					 </script>
						<?php
					}
				}

	?>
	<section>
		<div class="container">
			<div class="login-form">
				<h1>Iniciar Sesion</h1>
				<img src="images/login.png" alt="Usuario" height="100px" width="100px">
				<form action="FLogin.php" method="POST">
					<input type="text" name="user_name" placeholder="Usuario">
					<input type="password" name="user_password" placeholder="Contraseña">
					<input type="submit" name="Login" value="Login">
				</form>
				<a href="#" >¿Aún sin cuenta?</a>
			</div>
		</div>
	</section>

	<!--
	<section>
		<div class="container">
			<div class="registro-form" >
				<h1>Registrarse!!!</h1>

				<form action="PRegistro.php" method="POST">
					<input type="text" name="user_name" placeholder="Usuario">
					<input type="password" name="user_password" placeholder="Contraseña">
					<input type="submit" name="Registrar" value="Registrara">
				</form>
				<button onclick="cerrarModal()">¿Iniciar Sesion?</a>
			</div>
		</div>
	</section>
-->

	<!--Footer-->
  <nav class="navbar-bottom">
    <div class="foot">
          <p class="navbar-text-down">&copy <?php echo date('Y-M-D');?> - Team
           <a href="#" target="_blank" style="color: #191970">Sitios Web y Sistemas</a>
          </p>
          <p class="navbar-text-down">Sistema de S.A. de C.V.</p>
          <hr>
          <h6 align="center" style="color: #A4A4A4;">Si haces clic en "Acceder con Facebook" y no eres usuario de Spotify, quedarás registrado y aceptarás los Términos y Condiciones y la Política de Privacidad de Spotify.</h6>
      </div>
  </nav>
</body>
</html>

	<?php
}
