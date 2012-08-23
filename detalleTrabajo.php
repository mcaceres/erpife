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
<h1><?php echo $_SESSION['evento']; ?></h1>
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
if(isset($_POST['mail']))
{
	echo 'mail';
}
else
{
	echo "<p>
		<form name=\"corregir\" method=\"POST\" action=\"eval.php\" class=\"niceform\">
		<fieldset>
		<legend>Detalle del trabajo</legend>";
			conectar();
			$query = "SELECT t_id, t_titulo, a_descripcion, t_keywords, t_resumen, c_comentario, e_descripcion, u_nomyape, u_filiacion FROM estado INNER JOIN (area_tematica INNER JOIN (correcciones INNER JOIN (trabajo INNER JOIN usuario ON trabajo.t_ex_id = usuario.u_id) ON correcciones.c_t_id = trabajo.t_id) ON area_tematica.a_id = trabajo.t_area_id) ON estado.e_id = trabajo.t_estado WHERE trabajo.t_id = '" . $trabajo . "' ORDER BY c_id DESC LIMIT 0,1";
	//		echo $query;
			$lista = mysql_query($query);
			if(mysql_num_rows($lista) > 0)
			{	
				while($fila = mysql_fetch_array($lista))
				{
					echo "
					<dl>
						<dt><label for=\"numero\">Número de trabajo: </label></dt>
						<dd>" .  abs($fila['t_id']) . "</dd>
					</dl>
					<dl>
						<dt><label for=\"titulo\">Título: </label></dt>
						<dd><b><i>" . $fila['t_titulo'] . "</i></b></dd>
					</dl>
					<dl>
						<dt><label for=\"descripcion\">Área temática: </label></dt>
						<dd>" . $fila['a_descripcion'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"keywords\">Palabras clave: </label></dt>
						<dd>" . $fila['t_keywords'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"resumen\">Resumen: </label></dt>
						<dd>" . $fila['t_resumen'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"cantidad\">Cantidad de palabras: </label></dt>
						<dd>" . str_word_count($fila['t_resumen']) . "</dd>
					</dl>
					<dl>
						<dt><label for=\"correccion\">Corrección: </label></dt>
						<dd>" . $fila['c_comentario'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"estado\">Estado: </label></dt>
						<dd>" . $fila['e_descripcion'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"expositor\">Expositor: </label></dt>
						<dd>" . $fila['u_nomyape'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"filiacion\">Filiación: </label></dt>
						<dd>" . $fila['u_filiacion'] . "</dd>
					</dl>";
				}
			}
			else
			{
				$query = "SELECT t_id, t_titulo, a_descripcion, t_keywords, t_resumen, e_descripcion, u_nomyape, u_filiacion FROM estado INNER JOIN (area_tematica INNER JOIN (trabajo INNER JOIN usuario ON trabajo.t_ex_id = usuario.u_id) ON area_tematica.a_id = trabajo.t_area_id) ON estado.e_id = trabajo.t_estado WHERE trabajo.t_id = '" . $trabajo . "'";
	//			echo $query;
				$lista = mysql_query($query);
				while($fila = mysql_fetch_array($lista))
				{
					echo "
					<dl>
						<dt><label for=\"numero\">Número de trabajo: </label></dt>
						<dd>" .  abs($fila['t_id']) . "</dd>
					</dl>
					<dl>
						<dt><label for=\"titulo\">Título: </label></dt>
						<dd><b><i>" . $fila['t_titulo'] . "</i></b></dd>
					</dl>
					<dl>
						<dt><label for=\"descripcion\">Área temática: </label></dt>
						<dd>" . $fila['a_descripcion'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"keywords\">Palabras clave: </label></dt>
						<dd>" . $fila['t_keywords'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"resumen\">Resumen: </label></dt>
						<dd>" . $fila['t_resumen'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"estado\">Estado: </label></dt>
						<dd>" . $fila['e_descripcion'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"expositor\">Expositor: </label></dt>
						<dd>" . $fila['u_nomyape'] . "</dd>
					</dl>
					<dl>
						<dt><label for=\"filiacion\">Filiación: </label></dt>
						<dd>" . $fila['u_filiacion'] . "</dd>
					</dl>";
				}
			}
}
		echo "
		</fieldset>
		</form>
	</p>";
?>

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
