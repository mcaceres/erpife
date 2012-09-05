<?php
/*
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";
*/

function enviar_mail($tipo, $motivo, $titulo, $destinatario)
{
	$cant_trab = mysql_fetch_array(mysql_query("SELECT COUNT(t_asignado) FROM trabajo WHERE trabajo.t_asignado = '0'"));
	$textos = array();
	$textos['enviado_exp'] = $_SESSION['evento'] . " \n\nEstimado expositor " . $_SESSION['nomyape'] . ", su trabajo ha sido subido correctamente a la plataforma del " . $_SESSION['evento'] . "";
	$textos['enviado_eve'] = "Estimado administrador del " . $_SESSION['evento'] . ", se ha subido un nuevo trabajo a la plataforma web. Tiene " . $cant_trab['0'] . " trabajo/s sin asignar.";
	$textos['asignado_eva'] = $_SESSION['evento'] . "\n" . date('d-m-Y') . "\n\nEstimado evaluador " . $_SESSION['eva_nomyape'] . ", por el presente se le notifica que usted tiene trabajo/s para leer y considerar.\n Lo saluda atentamente. \nComité Organizador";
	$textos['evaluado'] = $_SESSION['evento'] . "\n" . date('d-m-Y') . "\n\nEstimado expositor " . $_SESSION['nomyape'] . ", por el presente se le notifica que su trabajo " . $_SESSION['t_titulo'] . " ha sido evaluado por el comité y ha resultado " . $_SESSION['t_estado'] . ".\n Lo saluda atentamente. \nComité Académico";

	switch ($tipo)
	{
		case "enviado_exp":
		{
			echo "<b> Motivo:</b> " . $motivo . "<br /><b> Título:</b> " . $titulo . "<br /><b> Destinatario:</b> " . $destinatario . "<br />";
			datos_email("enviado", $motivo, $titulo, $destinatario, $textos['enviado_exp']);
			echo "<br />Su trabajo ha sido enviado... <br />";
		};
		break;
		case "enviado_eve":
		{
			datos_email("enviado", $motivo, $titulo, $destinatario, $textos['enviado_eve']);
		};
		break;
		case "asignado_eva":
		{
			datos_email("asignado_eva", $motivo, $titulo, $destinatario, $textos['asignado_eva']);
		};
		break;
		case "evaluado":
		{
			datos_email("asignado_eva", $motivo, $titulo, $destinatario, $textos['evaluado']);
		};
		break;

		default: { ; }; break;
	}
}

function datos_email($status, $justificativo, $titulo, $destinatario, $texto)
{
//	echo "<br />" . $status . "<br />" . $justificativo . "<br />" . $titulo . "<br />" . $destinatario . "<br />";
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False 
	$mail->Username = "registro@erpife.com.ar"; // Tu cuenta de e-mail 
	$mail->Password = "nico1141"; // El Password de tu casilla de correos



	$mail->Host = "localhost";
//	echo "PPP: " . $_SESSION['eve_email'] . "<br />";
	$mail->From = $_SESSION['eve_email']; //verificar el mail
	$mail->FromName = "Administrador"; 
	$mail->Subject = "Modificación de estado de trabajo: " . $titulo; 
	$mail->AddAddress($destinatario, $_SESSION['nomyape']); //verificar nuevamente mail

	$mail->WordWrap = 100; 
	$body = $texto; 

	$mail->Body = $body; 

	//$mail->Send(); 

	//Notificamos al operador del estado del mensaje 
	if(!$mail->Send())
	{ 
		echo "No se pudo enviar el Mensaje."; 
	}
	else
	{
		echo  "<br/ >"; 
	}
echo "<br/ ><b>Cuerpo:</b>" . $body . "<br />";
	if(isset($motivo))
	{
		$body .= "<br />Motivo: " . $justificativo;
	}
}
/*
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$cad = "";
for($i=0;$i<8;$i++) {
$cad .= substr($str,rand(0,62),1);
}
print $cad;
*/
?>
