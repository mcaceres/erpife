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
<h2>Alta de �reas tem�ticas</h2><br />
<?php
extract($_POST);
//print_r($_POST);
	conectar();
	
?>

<p>
<form name="alta_usuario" method="POST" action="proc_alta_e.php" class="niceform">
<fieldset>
	<legend>Datos del �rea</legend>
	<dl>
		<dt><label for="descripcion">Descripci�n del �rea: </label></dt>
		<dd><input type="text" name="desc_area"></dd>
	</dl>
	<dl>
		<dd></dd>
		<input type="submit" name="enviar" value="Enviar">
		<input type="reset" name="limpiar" value="Limpiar">
	</dl>
</fieldset>
</form>

<form name="abm_areas" method="POST" action="mod_areas.php" class="niceform">
<fieldset>
	<?php
		conectar();
		$lista = mysql_query("SELECT a_id, a_descripcion FROM area_tematica ORDER BY a_descripcion");
		echo "<table>
		<tr><center><th>Id �rea</th><th>Descripci�n</th><th>Modificar</th></center></tr>";
		while($fila = mysql_fetch_array($lista))
		{
			echo "<tr>
			<td> " . $fila['a_id'] . "</td>
			<td> " . $fila['a_descripcion'] . "</td>
			<td> <input type=\"submit\" name=\"modificar\" value=\"" . $fila['a_id'] . "\"> </td>
			</tr>";
		}
		echo "</table>";
	?>
</fieldset>
</form>
</p>
