<?php
include_once('bdd2.php');
if(isset($_GET['codi'])) {
	$bdd = new BDD();
	$resultat = $bdd->enviar_correu($_GET['codi']);
	
}
else{
	$resultat = false;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Activar usuari per correu</title>
	</head>
	<body>
		<h1 style="text-align:center;">Activar usuari per correu</h1>
		<div style="display:inlibe-block;width:15%;float:left;">
			<ul>
				<li><a href='index.php'>Inici</a></li>
			</ul>
		</div>
		<div style="display:inlibe-block;width:85%;float:right;">
			<h2>Activar usuari per correu</h2>
			<p style="text-align:justify;padding:10px 50px 10px 10px;">
				<?php
				if($resultat) {					
					echo "<h2>Correu activació usuari enviat correctament!!!";
					}
				else{
					echo "<h2>Correu activació usuari NO enviat correctament, contacta amb l'administrador";
				}
				?>				
			</p>
		</div>
		
	</body>
</html>