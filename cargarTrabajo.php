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
<h2></h2>
<?php
extract($_POST);
//print_r($_POST);
//print_r($_SESSION);
	conectar();
	$id_usuario = mysql_fetch_array(mysql_query("SELECT u_id, u_nomyape FROM usuario WHERE u_username = '" . $_SESSION['usuario'] . "'"));
	$_SESSION['u_id'] = $id_usuario['u_id'];
?>
<form name="alta_usuario" method="POST" action="proc_trab.php" class="niceform">
<fieldset>
	<legend>Carga de ponencias</legend>
	<dl>
		<dt><label for="nombre">Expositor * : </label></dt>
		<dd><input type="text" name="expositor" value="<?php echo $id_usuario['u_nomyape']; ?>" READONLY></dd>
	</dl>	
	<dl>
		<dt><label for="titulo">Título del trabajo * : </label></dt>
		<dd><input type="text" name="titulo"></dd>
	</dl>
	<dl>
		<dt><label for="trabajo">Trabajo * (máximo 500 palabras): </label></dt>
		<dd><textarea name="trabajo" cols="70" rows="20"> </textarea></dd>
	</dl>
	<dl>
		<dt><label for="keywords">Palabras clave * : </label></dt>
		<dd><input type="text" name="keywords"></dd>
	</dl>
	<dl>
		<dt><label for="area">Área temática * : </label></dt>
		<dd>
			<select name="area">
			<?php
				conectar();
				$areas = mysql_query("SELECT * FROM area_tematica");
				while($fila = mysql_fetch_array($areas))
				{
					echo "<option value=\"" . $fila['a_id'] ."\"> " . ucfirst($fila['a_descripcion']) . "</option> \n";
				}
			?>
			</select>
		</dd>
	</dl>
	<dl>
		<dt></dt>
		<dd><i>Todos los campos son obligatorios </i><br />
		<input type="submit" name="enviar" value="Enviar">	</dd>
	</dl>
</fieldset>			

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

<p>


