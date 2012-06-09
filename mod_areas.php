<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
$cant = 1;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Sistema de Gestión de Ponencias Virtual SiGePoV</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="niceforms-default.css" media="forms" />
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
</head>
<body>
<div id="header">
<h1>Sistema de Gestión de Ponencias Virtual SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Modificación de datos de área temática</h2>
<?php
extract($_POST);
//print_r($_POST);
	conectar();
	echo "<pre>";
	$datos = mysql_query("SELECT a_descripcion, a_id FROM area_tematica WHERE a_id = '" . $modificar . "'");
	//print_r(mysql_fetch_array($datos));
	$fila_u = mysql_fetch_array($datos);
	print_r($fila_u);
	echo "</pre>";
?>
<p>
<form name="alta_usuario" method="POST" action="proc_mod_a.php" class="niceform">
<fieldset>
	<legend>Datos del área</legend>
	<dl>
		<dt><label for="nombre">Descripción : </label></dt>
		<dd><input type="text" name="descripcion" value="<?php echo $fila_u['a_descripcion']; ?>"></dd>
	</dl>
	<input type="hidden" name="a_id" value="<?php echo $fila_u['a_id']; ?>">
	<dl>
		<dd>Los campos marcados con * son obligatorios</dd>
		<input type="submit" name="guardar" value="Guardar cambios"><br />
		<input type="submit" name="eliminar" value="Eliminar área">
	</dl>
</fieldset>
</form>
</p>

