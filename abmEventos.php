<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
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
<h1><?php echo $_SESSION['evento']; ?> - SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Alta de áreas temáticas</h2><br />
<?php
extract($_POST);
//print_r($_POST);
	conectar();
?>

<p>
<form name="alta_usuario" method="POST" action="proc_mod_ev.php" class="niceform">
<fieldset>
	<?php
		$datos = mysql_fetch_array(mysql_query("SELECT * FROM evento LIMIT 0,1"));
	?>
	<legend>Datos del evento</legend>
	<input type="hidden" name="eve_id" value="<?php echo $datos['eve_id']; ?>">
	<dl>
		<dt><label for="desc_evento">Descripción del evento: </label></dt>
		<dd><input type="text" name="desc_evento" value="<?php echo $datos['eve_nombre']; ?>"></dd>
	</dl>
	<dl>
		<dt><label for="anio">Año del evento: </label></dt>
		<dd><input type="text" name="anio" value="<?php echo $datos['eve_anio']; ?>"></dd>
	</dl>
	<dl>
		<dt><label for="email">Correo electrónico: </label></dt>
		<dd><input type="text" name="email" value="<?php echo $datos['eve_email']; ?>"></dd>
	</dl>
	<dl>
		<dd></dd>
		<input type="submit" name="enviar" value="Enviar">
		<input type="reset" name="limpiar" value="Limpiar">
	</dl>
</fieldset>
</form>
</div>
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
