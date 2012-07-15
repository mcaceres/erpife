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
<h1>Sistema de Gestión de Ponencias Virtual SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Asignación de trabajos</h2><br /><br />
<?php
extract($_POST);
//print_r($_POST);
	conectar();
?>
<form name="asignar_trabajo" method="POST" action="proc_asignacion_t.php" class="niceform">
<fieldset>
	<legend>Asignación de trabajos a evaluadores</legend>
	<dl>
		<dt><label for="perfil">Perfil : </label></dt>
		<dd>
			<select name="perfil">
			<?php
				conectar();
				$perfiles = mysql_query("SELECT t_id, t_ex_id, t_titulo, t_area_id, a_descripcion FROM trabajo, area_tematica WHERE trabajo.t_area_id = area_tematica.a_id");
				while($fila = mysql_fetch_array($perfiles))
				{
					echo "<option value=\"" . $fila['t_id'] ."\"> " . ucfirst($fila['t_titulo']) . " - " . ucfirst($fila['a_descripcion']) . "</option> \n";
				}
			?>
			</select>
		</dd>
	</dl>

</fieldset>
</form>
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
