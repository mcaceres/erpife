<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Gesti�n de ponencias IAES</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="niceforms-default.css" media="forms" />
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
</head>
<body>
<div id="header">
<h1>Gesti�n de ponencias IAES</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Alta de usuario</h2>
<p>
<form name="alta_usuario" method="POST" action="proc_alta_u.php" class="niceform">
<fieldset>
	<legend>Datos del usuario</legend>
	<dl>
		<dt><label for="nombre">Nombre(s) : </label></dt>
		<dd><input type="text" name="nombre"></dd>
	</dl>
	<dl>
		<dt><label for="apellido">Apellido : </label></dt>
		<dd><input type="text" name="apellido"></dd>
	</dl>
	<dl>
		<dt><label for="dni" name="dni">D. N. I. : </label></dt>
		<dd><input type="text" name="dni"></dd>
	</dl>
	<dl>
		<dt><label for="email">Email : </label></dt>
		<dd><input type="text" name="email"></dd>
	</dl>
	<dl>
		<dt><label for="password">Contrase�a : </label></dt>
		<dd><input type="password" name="password"></dd>
	</dl>
	<dl>
		<dt><label for="verif">Repetir contrase�a : </label></dt>
		<dd><input type="password" name="verif"></dd>
	</dl>
	<dl>
		<dt><label for="perfil">Repetir contrase�a : </label></dt>
		<dd>
			<select name="perfil">
			<?php
				conectar();
				$perfiles = mysql_query("SELECT * FROM perfil");
				printf($perfiles);
				while($fila = mysql_fetch_array($perfiles))
				{
					echo "<option value=\"" . $fila['perfil_id'] ."\"> " . $fila['descripcion'] . "</option>";
				}
			?>
			</select>
		</dd>
	</dl>
	<dl>
		<dd>Los campos marcados con * son obligatorios</dd>
		<input type="submit" name="enviar" value="Enviar">
	</dl>
</fieldset>
</form>
</p>
</div>
	
<div id="left">
<?php

if(!isset($_SESSION['usuario']))
{
	insertar('login');
}
?>			
	<div class="box">
				<h2>Links :</h2>
				<ul>
				<li><a href="http://www.minimalistic-design.info">Web Design Directory</a></li>
				<li><a href="http://www.historyexplorer.net">History Timelines</a></li>
				<li><a href="http://www.minimalistic-design.net">Free templates</a></li>
				</ul>
	</div>
		
    <div class="box">
	   <div style="font-size: 0.8em;">Design by <a href="http://www.minimalistic-design.net">Minimalistic Design</a></div>
	</div>
</div>
</div>
</body>
</html>
