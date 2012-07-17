<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
//include "ctrl_sesion.php";
include "func_conn.php";
include "menu_perfil.php";

	conectar();
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
<h2>Bienvenido</h2>
<p>
	<?php
		if(isset($_SESSION['usuario']))
		{
			echo "Bienvenido " . $_SESSION['nomyape'] . ", utilice el menú superior para seleccionar las opciones que desee.";
		}
		else
		{
			echo "Bienvenido, identifíquese para poder acceder a las diferentes opciones.";
		}
	?>

<form name="lista" method="POST" action="modificarTrabajo.php" class="niceform">
<?php
	if($_SESSION['perfil'] == 'expositor')
	{
		echo '<form name="lista" method="POST" action="bm.php" class="niceform">';
		conectar();
		$lista = mysql_query("SELECT t_id, u_nomyape, a_descripcion, t_titulo, e_id FROM estado, trabajo, usuario, area_tematica WHERE trabajo.t_ex_id = usuario.u_id AND area_tematica.a_id = trabajo.t_area_id AND usuario.u_username = '" . $_SESSION['usuario'] . "'  AND estado.e_id = t_estado ORDER BY t_id");
		echo "<table>
		<tr><center><th>ID Trabajo</th><th>Título</th><th>Área</th><th>Modificar</th></center></tr>";
		while($fila = mysql_fetch_array($lista))
		{
			echo "<tr>
			<td> " . $fila['t_id'] . "</td>
			<td> " . $fila['t_titulo'] . "</td>
			<td> " . $fila['a_descripcion'] ."</td>";
			if($fila['e_id'] == 1 OR $fila['e_id'] == 5)
			{
				echo "<td><input type=\"submit\" name=\"modificar\" value=\"" . $fila['t_id'] . "\"> </td>";
			}
			else
			{
				$desc_estado = mysql_fetch_array(mysql_query("SELECT e_descripcion FROM estado, trabajo WHERE estado.e_id = trabajo.t_estado AND trabajo.t_id = '" . $fila['t_id'] . "'"));
				echo "<td> " . $desc_estado['e_descripcion'] . "</td>";
			}
			"</tr>";
		}
		echo "</table>";
	}
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
