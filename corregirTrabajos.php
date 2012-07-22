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
<h1><?php echo $_SESSION['evento']; ?></h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Trabajos asignados</h2>
<?php
extract($_POST);
//print_r($_POST);
//print_r($_SESSION);
	conectar();
?>
<br />
<p>
	<form name="corregir" method="POST" action="eval.php" class="niceform">
	<fieldset>
	<legend>Trabajos asignados</legend>
	<?php
		conectar();
		$lista = mysql_query("SELECT t_id, t_keywords, t_area_id, t_resumen, a_descripcion FROM asignaciones INNER JOIN (trabajo INNER JOIN area_tematica ON trabajo.t_area_id = area_tematica.a_id) ON trabajo.t_id = asignaciones.as_id_trabajo AND asignaciones.as_id_evaluador = '" . $_SESSION['u_id'] . "'");
		while($fila = mysql_fetch_array($lista))
		{
			echo "
			<dl>
				<dt><label for=\"numero\">N�mero de trabajo: </label></dt>
				<dd><input type=\"text\" name=\"numero\" size=\"4\" value=\"" . $fila['t_id'] . "\" READONLY></dd>
			</dl>
			<dl>
				<dt><label for=\"keyword\">Palabras clave: </label></dt>
				<dd><input type=\"text\" name=\"keyword\" size=\"50\" value=\"" . $fila['t_keywords'] . "\" READONLY></dd>
			</dl>
			<dl>
				<dt><label for=\"descripcion\">�rea tem�tica: </label></dt>
				<dd><input type=\"text\" name=\"descripcion\" size=\"40\" value=\"" . $fila['a_descripcion'] . "\" READONLY></dd>
			</dl>
<!--			<dl>
				<dt><label for=\"trabajo\">Resumen: </label></dt>
				<dd><textarea rows=\"30\" cols=\"80\" READONLY>" . $fila['t_resumen'] . "</textarea></dd>
			</dl>-->
			<dl>
				<dt><label for=\"enviar\"></label></dt>
				<dd><input type=\"submit\" name=\"evaluar\" value=\" Corregir trabajo " . abs($fila['t_id']) . "\"></dd>
			</dl>";
		}
	?>
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
<p>
</body>
</html>
