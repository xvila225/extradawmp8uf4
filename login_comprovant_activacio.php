<?php
include_once('bdd2.php');

session_start();
$durada_sessio=10;

if( !isset($_SESSION['last_access'])){
	$_SESSION['last_access'] = time(); 
}
if((time() - $_SESSION['last_access']) > $durada_sessio){
	echo "<p style='color:blue;'>Sessió caducada, tornat a registrar.</p>";
	$_SESSION['last_access'] = time();
}  


if(isset($_SESSION['ready']) && $_SESSION['ready'] ) {
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
		if($bdd->exists_user_activat($user, $pass)) {
			//variable de sessió per indicar que s'ha començat correctament
			$_SESSION['ready'] = true;
			header('Location: primera.php');
			exit;
		}
		else {
			//usuari o pass incorrecte
		}
	}
	else {
		//no s'han rebut dades del form
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN</title>
	</head>
	<body>
		<h1>Login usuari compte activat</h1>
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
		</ul>
		
		
		
		
	</body>
</html>