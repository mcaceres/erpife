<?php
	
function insertar($var)
{
$menu_expositor = '<div id="menu">
  <ul id="nav">
   <li><a href="index.php">Inicio</a></li>
   <li><a href="cargarTrabajo.php">Cargar Trabajo</a></li>
   <li><a href="verCorrecciones.php">Ver correcciones</a></li>
   <li><a href="perfil.php">Perfil</a></li>
   <li><a href="salir.php">Salir</a></li>
  </ul>
 </div>';

$menu_evaluador = '<div id="menu">
  <ul id="nav">
	<li><a href="index.php">Inicio</a></li>
	<li><a href="corregirTrabajos.php">Corregir trabajos</a></li>
	<li><a href="listarTrabajos.php">Ver trabajos</a></li>
   <li><a href="perfil.php">Perfil</a></li>
	<li><a href="salir.php">Salir</a></li>
  </ul>
 </div>';

$menu_admin = '<div id="menu">
  <ul id="nav">
   <li><a href="index.php">Inicio</a></li>
   <li><a href="altaUsuario.php">Alta de usuario</a></li>
   <li><a href="listaUsuario.php">Ver usuarios</a></li>
   <li><a href="abmEventos.php">Alta eventos</a></li>
   <li><a href="asignarTrabajo.php">Asignar trabajos</a></li>
   <li><a href="perfil.php">Perfil</a></li>
   <li><a href="salir.php">Salir</a></li>
  </ul>
 </div>';

$caja_login = '<div class="box">
		<form name="login" method="POST" action="control.php">
		<h2>Identificarse</h2>	
		<p>Usuario<input type="text" name="username"></p>
		<p>Contraseña<input type="password" name="password"></p>
		<p><input type="submit" name="enviar" value="Enviar"></p>
		</form>
	</div>';
	
$inicial = '
<div id="menu">
	<ul id="nav">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="registro.php">Registrarse</a></li>
	</ul>
</div>';

	switch ($var)
	{
		case "expositor": { echo $menu_expositor; }; break;
		case "evaluador": { echo $menu_evaluador; }; break;
		case "admin": { echo $menu_admin; }; break;
		case "login": { echo $caja_login; }; break;
		default: { echo $inicial; }; break;
	}
}
