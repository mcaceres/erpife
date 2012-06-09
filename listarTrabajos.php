<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
include "ctrl_sesion.php";
include "menu_perfil.php";
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
<h2>Listado de usuarios</h2>
<p>
	<form name="lista" method="POST" action="bm.php" class="niceform">
	<?php
		conectar();
		$lista = mysql_query("SELECT t_id, u_nomyape, a_descripcion, t_titulo FROM trabajo, usuario, area_tematica WHERE trabajo.t_ex_id = usuario.u_id AND area_tematica.a_id = trabajo.t_area_id");
		echo "<table>
		<tr><center><th>ID Trabajo</th><th>Título</th><th>Área</th></center></tr>";
		while($fila = mysql_fetch_array($lista))
		{
			echo "<tr>
			<td> " . $fila['t_id'] . "</td>
			<td> " . $fila['t_titulo'] . "</td>
			<td> " . $fila['a_descripcion'] ."</td>
			<td> " . ucfirst($fila['descripcion']) . "</td>
			</tr>";
		}
		echo "</table>";
	?>
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

