<?php
include_once('bdd2.php');

$user = '';
$pass = '';
$nom = '';
$cognom1 = '';
$cognom2 = '';
$correu = '';

//recupera form de login
if(isset($_POST['login'])) {
	$user = (isset($_POST['user']))? $_POST['user'] : null;
	$pass = (isset($_POST['pass']))? $_POST['pass'] : null;
	$nom = (isset($_POST['nom']))? $_POST['nom'] : null;
	$cognom1 = (isset($_POST['cognom1']))? $_POST['cognom1'] : null;
	$cognom2 = (isset($_POST['cognom2']))? $_POST['cognom2'] : null;
	$correu = (isset($_POST['correu']))? $_POST['correu'] : null;
	$codi_activacio = mt_rand();
	
	if($user !== '' && $pass !== '' && $nom !== '' && $cognom1 !== '' && $cognom2 !== '' && $correu !== '' && $codi_activacio !== '') {
		$bdd = new BDD();
		if($bdd->insert_user($user, $pass, $nom, $cognom1, $cognom2, $correu, $codi_activacio)){
			header('Location: info_activar_usuari.php?codi='.$codi_activacio);
			exit;
		}
		else{
			echo "<p style='color:red;'>Error al crear usuari, contacta amb l'administrador</p>";
		}
		
	}
	else{
		echo "<p style='color:red;'>Falta algún paràmetre!</p>";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>REGISTRE</title>
	</head>
	<body>
		<h1>REGISTRE NOU USUARI</h1>
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
					<td>
						<label for="nom">Nom</label><br />
						<input type="text" name="nom" value ="<?php echo $nom; ?>"/>
					</td>
					<td>
						<label for="cognom1">1r Cognom</label><br />
						<input type="text" name="cognom1" value ="<?php echo $cognom1; ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="cognom2">2n Cognom</label><br />
						<input type="text" name="cognom2" value ="<?php echo $cognom2; ?>"/>
					</td>
					<td>
						<label for="correu">@ Correu</label><br />
						<input type="email" name="correu" value ="<?php echo $correu; ?>"/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="login" value="OK" />
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