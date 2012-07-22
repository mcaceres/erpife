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
<form name="asignar_trabajo" method="POST" action="proc_asignacion_t.php"> <!-- class="niceform" -->
<fieldset>
	<legend>Asignación de trabajos a evaluadores</legend>
	<dl>
	<dt><label for="trabajos">Trabajos sin asignar</label></dt>
	<dd>
<?php
	$trabajos = mysql_query("SELECT t_id, t_titulo, t_area_id FROM trabajo, area_tematica WHERE trabajo.t_area_id = area_tematica.a_id AND trabajo.t_asignado = '0' ORDER BY t_area_id");
//	print_r($trabajos);
//	print_r($evaluadores);
	while($fila = mysql_fetch_array($trabajos))
	{
		echo "<input type=\"checkbox\" name=\"trabajo" . $fila['t_id'] . "\" value=\"" . $fila['t_id'] . "\"> " . $fila['t_titulo'] . " <b>[" . abs($fila['t_area_id']) . "] </b><br />";
	}
?>	
	</dd>
	</dl>
	<dl>
	<dt><label for="evaluadores">Evaluadores</label></dt>
	<dd>
<?php
	$evaluadores = mysql_query("SELECT u_id, u_nomyape FROM usuario WHERE usuario.u_perfil = '2'");
//	print_r($trabajos);
//	print_r($evaluadores);
	while($fila = mysql_fetch_array($evaluadores))
	{
		echo "<input type=\"radio\" name=\"evaluador\" value=\"" . $fila['u_id'] . "\"> " . $fila['u_nomyape'];
		$asignados = mysql_query("SELECT as_id FROM asignaciones WHERE asignaciones.as_id_evaluador = '" . $fila['u_id'] . "'");
		$cant = mysql_num_rows($asignados); echo " <b>(" . $cant . ") </b><br />";
	}
?>	
	</dd>
	</dl>
	<input type="submit" name="modificar" value="Asignar">
</fieldset>
</form>
</div>


<div id="left">
<?php
/* Porción de código para hacer un select con los trábajos...
	<dl>
		<dt><label for="perfil">Trabajo : </label></dt>
		<dd>
			<select name="perfil">
			<?php
				conectar();
				$perfiles = mysql_query("SELECT t_id, t_titulo, t_area_id FROM trabajo, area_tematica WHERE trabajo.t_area_id = area_tematica.a_id AND trabajo.t_asignado = 0");
				while($fila = mysql_fetch_array($perfiles))
				{
					echo "<option value=\"" . $fila['t_id'] ."\"> " . ucfirst($fila['t_titulo']) . " - " . ucfirst($fila['a_descripcion']) . "</option> \n";
				}
			?>
			</select>
		</dd>
	</dl>
*/
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

