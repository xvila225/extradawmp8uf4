<?php
session_start();
$durada_sessio=300;
//comprova si la sessió està iniciada
if(!isset($_SESSION)|| !isset($_SESSION['ready'])) {
	exit("<h1>403 Forbidden</h1>Aquesta pàgina requereix registre1.<br><a href='index.php'>Inici</a>");
}
else if(!$_SESSION['ready']) {
	exit("<h1>403 Forbidden</h1>Aquesta pàgina requereix registre2.<br><a href='index.php'>Inici</a>");
}

if((time() - $_SESSION['last_access']) > $durada_sessio ){
	echo "<p style='color:blue;'>Sessió caducada, tornat a registrar.</p>";
	$_SESSION['ready']=false;
	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Segona</title>
	</head>
	<body>
		<h1 style="text-align:center;">SEGONA</h1>
		<div style="display:inlibe-block;width:15%;float:left;">
			<ul>
				<li><a href='index.php'>Inici</a></li>
				<li><a href="primera.php">Primera</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		<div style="display:inlibe-block;width:85%;float:right;">
			<h2>Segona pàgina</h2>
			<p style="text-align:justify;padding:10px 50px 10px 10px;">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc gravida mi justo, in egestas orci commodo et. Vivamus sit amet mollis tortor. Donec ac molestie sem. Mauris consectetur tellus et turpis vestibulum auctor. In at lobortis ante. Quisque tristique, ante fringilla posuere tincidunt, risus quam luctus lacus, id ornare mauris lacus sed arcu. Pellentesque diam nisi, varius ac nibh placerat, euismod ultricies neque. Aliquam vitae odio lacus. Integer sodales rutrum velit. Aliquam dignissim tempor blandit. Pellentesque gravida eu mi ut pretium. Donec lectus arcu, elementum et placerat at, tempus vel enim. Morbi dictum id arcu elementum dapibus. Maecenas eget feugiat nisi.
				<br /><br />
				Integer quam purus, consectetur a pellentesque non, egestas eget velit. Fusce vitae ex id sapien finibus porta id sed leo. Duis rutrum ex tempor, malesuada sapien sit amet, fermentum est. Sed accumsan ex at iaculis volutpat. Nunc ante nulla, maximus nec sapien ut, porttitor commodo ipsum. Nunc consequat, massa varius venenatis ultrices, ligula nulla mattis augue, vel dapibus purus magna ac dui. Aenean a mi mi. Vivamus ut bibendum lectus. Proin vitae sapien vitae leo mattis laoreet. Praesent maximus quis diam eget vehicula. Etiam porta diam vitae enim convallis, id fermentum nulla rhoncus. Fusce mauris velit, pellentesque et imperdiet nec, convallis eget eros. 
			</p>
		</div>
	</body>
</html>