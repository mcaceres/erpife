<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
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
<h1>Sistema de Gesti�n de Ponencias Virtual SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Datos de perfil</h2><br />
<?php
	conectar();
print_r($_SESSION);

	$fila_u = mysql_fetch_assoc(mysql_query("select u_id, u_username, u_password, u_dni, u_email, u_nomyape FROM usuario WHERE u_username = 'mcaceres'"));
	print_r($fila_u);
?>
<form name="mod_datos" method="POST" action="proc_mod_u.php" class="niceform">
<fieldset>
	<legend>Datos</legend>
	<dl>
		<dt><label for="nombre">Nombre y Apellido *: </label></dt>
		<dd><input type="text" name="nomyape" value="<?php echo $fila_u['u_nomyape']; ?>"></dd>
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
	<input type="hidden" name="u_id" value="<?php echo $fila_u['u_id']; ?>">
	<dl>
		<dd>Los campos marcados con * son obligatorios</dd>
		<input type="submit" name="guardar" value="Guardar cambios"><br />
	</dl>
</fieldset>
</form>

<p>


