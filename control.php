<html>
  <head>
    <title></title>
    <meta content="">
    <style></style>
  </head>
  <body>
<br /><br />

<?php
include 'func_conn.php';
conectar();
//print_r($_POST);
if(isset($_POST['enviar']))
{
	$user_pass = mysql_fetch_array(mysql_query("SELECT u_username, u_password, descripcion, u_nomyape FROM usuario, perfil WHERE usuario.u_username = '" . $_POST['username'] . "' AND usuario.u_perfil = perfil.perfil_id"));
	if($user_pass == "")
	{
		echo "El usuario no existe";
	}
	else
	{
		if($user_pass['u_password'] == $_POST['password'])
		{
			session_start();
			$_SESSION['usuario'] = $_POST['username']; $_SESSION['perfil'] = $user_pass['descripcion']; $_SESSION['nomyape'] = $user_pass['u_nomyape'];
			header("location:index.php");
		}
		else
		{
			echo "<fieldset>Contraseña incorrecta</fieldset>";
		}
	}
}
else
{
	echo "<fieldset>Debe ingresar desde la página de inicio, autenticando usuario y contraseña <a href=\"index.php\">Inicio</a></fieldset>";
}

?>
</body>
</html>
