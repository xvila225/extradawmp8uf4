<?php
include_once('bdd2.php');
if(isset($_GET['codi'])) {
	$bdd = new BDD();
	$resultat = $bdd->activar_user($_GET['codi']);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Activar usuari</title>
	</head>
	<body>
		<h1 style="text-align:center;">Activar usuari</h1>
		<div style="display:inlibe-block;width:15%;float:left;">
			<ul>
				<li><a href='index.php'>Inici</a></li>
			</ul>
		</div>
		<div style="display:inlibe-block;width:85%;float:right;">
			<h2>Activar usuari</h2>
			<p style="text-align:justify;padding:10px 50px 10px 10px;">
				<?php
				if($resultat) {					
					echo "<h2>Usuari activat correctament!!!";
					}
				else{
					echo "<h2>Usuari NO activat correctament, contacta amb l'administrador";
				}
				?>				
			</p>
		</div>
		
	</body>
</html>