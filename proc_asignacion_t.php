<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
include 'mail.php';
require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer

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
<h2>Asignación de trabajos</h2>
<br />
<?php
extract($_POST);
//print_r($_POST);
//echo "<br />\n";
//print_r($_SESSION);
	conectar();
		if(isset($asignar))
		{
			$expositor = mysql_fetch_array(mysql_query("SELECT t_id, t_ex_id, u_nomyape FROM trabajo INNER JOIN usuario ON trabajo.t_ex_id = u_id AND trabajo.t_id = '" . $trabajo . "'"));
			extract($expositor);
			if($t_ex_id == $evaluador)
			{
				echo "<br />El expositor y el evaluador son la misma persona. <br />\nNo se puede asignar el trabajo <b><i>" . $t_titulo . "</i></b> al evaluador <b><i>" . $u_nomyape . "</i></b>";
			}
			else
			{
				$receptor = mysql_fetch_assoc(mysql_query("SELECT u_email FROM usuario INNER JOIN trabajo ON usuario.u_id = trabajo.t_ex_id WHERE trabajo.t_id = '" . $trabajo . "'"));
				extract($receptor);
				enviar_mail("asignado_eva", "Se le ha asignado un trabajo...", $t_titulo, $u_email);
				$query = "INSERT INTO asignaciones (as_id_trabajo, as_id_evaluador) VALUES ('" . $trabajo . "', '" . $evaluador . "')";
				mysql_query($query);
				$eva_nomyape = mysql_fetch_array(mysql_query("SELECT u_nomyape FROM usuario WHERE u_id = '" . $evaluador . "'"));
				$_SESSION['eva_nomyape'] = $eva_nomyape['u_nomyape'];
				$query2 = "UPDATE trabajo SET t_estado = '3', t_asignado = '1' WHERE trabajo.t_id = '" . $trabajo . "'";
				$insert = mysql_query($query2);
				if(!mysql_error())
				{
					echo "<br /><b>Trabajo asignado correctamente</b>";
					//echo '<meta http-equiv="Refresh" content="5;url=index.php">';
				}
				else
				{
					echo "<br />Hubo un error <br />" . mysql_errno() . " " . mysql_error();
				}
			}
		}
?>
<p>


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
<?php
/*
				$query = "INSERT INTO asignaciones (as_id_trabajo, as_id_evaluador) VALUES ('" . $valor . "', '" . $evaluador . "')";
				//echo $query . "<br />";
				$receptor = mysql_fetch_assoc(mysql_query("SELECT u_email FROM usuario INNER JOIN trabajo ON usuario.u_id = trabajo.t_ex_id WHERE trabajo.t_id = '" . $valor . "'"));
				//print_r($receptor);
				$insert = mysql_query($query);
				echo "<br />" . mysql_error() . "<br />";
				$query2 = "UPDATE trabajo SET t_estado = '3', t_asignado = '1' WHERE trabajo.t_id = '" . $valor . "'";
				//echo $query2;
				$insert = mysql_query($query2);

				$mail = new PHPMailer(); 
				$mail->IsSMTP(); 
				$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False 
				$mail->Username = "registro@erpife.com.ar"; // Tu cuenta de e-mail 
				$mail->Password = "nico1141"; // El Password de tu casilla de correos

				$mail->Host = "localhost";
				
				$query = "SELECT eve_email, eve_nombre, eve_anio FROM evento";
				$datos = mysql_fetch_assoc(mysql_query($query));
				$mail->From = $datos['eve_email']; 
				$mail->FromName = "Administrador"; 
				$mail->Sender = $datos['eve_email']; 
				$mail->Subject = "Modificación de estado de trabajo..."; 
				$mail->AddAddress($receptor['u_email'], $datos['eve_email']); 

				$mail->WordWrap = 50; 

				$body = "Su trabajo a sido asignado a un evaluador. Será notificado cuando sufra otro cambio de estado (Rechazado, Aprobado, Para revisión)."; 
	//			$body .= "\n\nPara modificar cualquiera de estos datos, inicie sesión en el sistema y en la opción 'Perfil' podrá hacerlo.\n\nPara solicitar un cambio de perfil (a Evaluador), dirigirse al mismo mail, expresando en el asunto 'Cambio de perfil: Evaluador' y enviando sus datos personales."; 

				$mail->Body = $body; 

				//$mail->Send(); 

				// Notificamos al usuario del estado del mensaje 
	echo "<pre>";
	//print_r($mail);
	echo "</pre>";
				if(!$mail->Send())
				{ 
					echo "No se pudo enviar el Mensaje."; 
				}
				else
				{ 
					echo nl2br($body) . "<br/ >"; 
				}

*/
?>
