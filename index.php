<?php
include_once('bdd2.php');

session_start();
$durada_sessio=300;

if( !isset($_SESSION['last_access'])){
	$_SESSION['last_access'] = time(); 
}
if((time() - $_SESSION['last_access']) > $durada_sessio){
	echo "<p style='color:blue;'>Sessió caducada, tornat a registrar.</p>";
	$_SESSION['ready'] = false;
	$_SESSION['last_access'] = time();
}  


if(isset($_SESSION['ready']) && $_SESSION['ready']) {
			header('Location: primera.php');
			exit;
}

$user = '';
$pass = '';

//recupera form de login
if(isset($_POST['login'])) {
	$user = (isset($_POST['user']))? $_POST['user'] : null;
	$pass = (isset($_POST['pass']))? $_POST['pass'] : null;
	
	if($user !== null && $pass !== null) {
		$bdd = new BDD();
		//comprovar si el usuari està registrat i activat
		if($bdd->exists_user($user, $pass) && $bdd->exists_user_activat($user, $pass)) {
			//variable de sessió per indicar que s'ha començat correctament
			$_SESSION['ready'] = true;
			header('Location: primera.php');
			exit;
		}
		else if($bdd->exists_user($user, $pass) && !$bdd->exists_user_activat($user, $pass)){
			echo "<h3 style='color:red;'>Usuari registrat, però sense activar, contacta amb l'administrador!!!</h3>";
		}	
		else {
			//usuari o pass incorrecte
			//echo "no";
			echo "<h3 style='color:red;'>Usuari o contrasenya incorrectes</h3>";
		}
	}
	else {
		//no s'han rebut dades del form
		//echo "no form";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN</title>
	</head>
	<body>
		<h1>Login amb compte activat o no</h1>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label for="user">Usuari</label><br />
						<input type="text" name="user" value ="<?php echo $user; ?>"/>
					</td>
					<td>
						<label for="pass">Contrassenya</label><br />
						<input type="password" name="pass" value ="<?php echo $pass; ?>"/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="login" value="Conectar" />
					</td>
				</tr>
			</table>
		</form>
		<ul>
			<li><a href="primera.php">Primera</a></li>
			<li><a href="segona.php">Segona</a></li>
			<li><a href="registre.php">Registrar-se</a></li>
			<!--<li><a href="login_comprovant_activacio.php">Login usuari activat</a></li>-->			
		</ul>
		
		
		
		
	</body>
</html>