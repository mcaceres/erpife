<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
$cant = 1;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Sistema de Gesti�n de Ponencias Virtual SiGePoV</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="niceforms-default.css" media="forms" />
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
</head>
<body>
<div id="header">
<h1><?php echo $_SESSION['evento']; ?> - SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2><?php echo $_SESSION['evento']; ?> - SiGePoV</h2><br />
<?php
extract($_POST);
//print_r($_POST);
	conectar();
	echo "<pre>";
	$datos = mysql_query("SELECT u_id, u_username, u_perfil, u_email, u_nomyape, u_filiacion FROM usuario WHERE u_id = '" . $modificar . "'");
	//print_r(mysql_fetch_array($datos));
	$fila_u = mysql_fetch_array($datos);
	echo "</pre>";
?>
<p>
<form name="alta_usuario" method="POST" action="proc_mod_u.php" class="niceform">
<fieldset>
	<legend>Datos del usuario</legend>
	<dl>
		<dt><label for="nombre">Nombre y Apellido *: </label></dt>
		<dd><input type="text" name="nomyape" value="<?php echo $fila_u['u_nomyape']; ?>"></dd>
	</dl>
	<dl>
		<dt><label for="nombre">Nombre de usuario *: </label></dt>
		<dd><input type="text" name="username" value="<?php echo $fila_u['u_username']; ?>"></dd>
	</dl>
	<dl>
		<dt><label for="dni" name="dni">D. N. I. *: </label></dt>
		<dd><input type="text" name="dni" value="<?php echo $fila_u['u_dni']; ?>"></dd>
	</dl>
	<dl>
		<dt><label for="email">Email *: </label></dt>
		<dd><input type="text" name="email" value="<?php echo $fila_u['u_email']; ?>"></dd>
	</dl>
	<dl>
		<dt><label for="password">Contrase�a *: </label></dt>
		<dd><input type="password" name="password"></dd>
	</dl>
	<dl>
		<dt><label for="verif">Repetir contrase�a *: </label></dt>
		<dd><input type="password" name="verif"></dd>
	</dl>
	<dl>
		<dt><label for="perfil">Perfil : </label></dt>
		<dd>
			<select name="perfil">
			<?php
				conectar();
				$perfiles = mysql_query("SELECT * FROM perfil");
				while($fila = mysql_fetch_array($perfiles))
				{
					if($fila_u['u_perfil'] == $fila['perfil_id'])
					{
						echo "<option selected=\"" . $fila['perfil_id'] . "\" value=\"" . $fila['perfil_id'] ."\"> " . ucfirst($fila['descripcion']) . "</option> \n";						
					}
					else
					{
						echo "<option value=\"" . $fila['perfil_id'] ."\"> " . ucfirst($fila['descripcion']) . "</option> \n";						
					}
				}
			?>
			</select>
		</dd>
	</dl>
	<input type="hidden" name="u_id" value="<?php echo $fila_u['u_id']; ?>">
	<dl>
		<dd>Los campos marcados con * son obligatorios</dd>
		<input type="submit" name="guardar" value="Guardar cambios"><br />
		<input type="submit" name="eliminar" value="Eliminar usuario">
	</dl>
</fieldset>
</form>
</p>
</div>
<div id="left">
<?php
//print_r($_SESSION);
if(!isset($_SESSION['usuario']))
{
	insertar('login');
}
?>			
	<div class="box">
				<h2>Links :</h2>
				<ul>
				<li><a href="http://www.iaes.edu.ar">IAES Puerto Rico</a></li>
				</ul>
	</div>
		
    <div class="box">
	   <div style="font-size: 0.8em;">Design by <a href="http://www.minimalistic-design.net">Minimalistic Design</a></div>
	</div>
</div>
</div>
</body>
</html>
