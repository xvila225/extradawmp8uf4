<!DOCTYPE html>
<html>
	<head>
		<title>Info activar usuari</title>
	</head>
	<body>
		<h1 style="text-align:center;">Info activar usuari</h1>
		<div style="display:inlibe-block;width:15%;float:left;">
			<ul>
				<li><a href='index.php'>Inici</a></li>
			</ul>
		</div>
		<div style="display:inlibe-block;width:85%;float:right;">
			<h2>Activar usuari</h2>
			<p style="text-align:justify;padding:10px 50px 10px 10px;">
				Segueix el següent enllaç per activar el compte
				
				<?php echo "<br /><br /><a href='activar_usuari_web.php?codi=".$_GET['codi']."'>Activar compte web</a>";?>
				
				<?php echo "<br /><br /><a href='activar_usuari_correu.php?codi=".$_GET['codi']."'>Activar compte correu </a>";?>
				
				
				
				
				
			</p>
		</div>
		
	</body>
</html>