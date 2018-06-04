<?php

class BDD {
	
	//funció per crear una nova connexió amb la BBDDD
	function crearConnexio(){
		//Connexió BBBDD
		$servername = "localhost";
		$username = "usuaridaw";
		$password = "1a2a3a4a5a";
		$dbname = "webdaw";

		// Create connection
		$conn = @new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			echo "<p style='color:blue;'>Error al conectar amb la BBDD: \"" . $conn->connect_error."\"</p>";
			return false;
		}
		//echo "Connected successfully <br/>";
		return $conn;
	}
	
	//Funció per comprovar si existeix un usuari i la seva contrasenya a la BBDD
	//Aquesta funció no comprova si el compte està o no activat
	public function exists_user($user = '', $pass = '') {
		if(strcmp($user, '') == 0 && strcmp($pass, '') == 0){
			return false;
		}
		
		$conn=$this->crearConnexio();
		if(!$conn){
			return false;
		}

		$sql = "SELECT id_usuari, usuari, contrasenya FROM usuaris where usuari='".$user."'";
		//echo $sql;
		$result = $conn->query($sql);
		//comparar contrasenyes bbdd amb la del formulari		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				if(strcmp($row["usuari"],$user)==0 && strcmp($row["contrasenya"],$pass)==0){
					$conn->close();	
					return true;
				}			
			}
		} 
			//echo "0 results";
			//echo "<h3 style='color:red;'>Usuari o contrasenya incorrectes</h3>";
			$conn->close();	
			return false;
		
				
	}

	//Funció per comprovar si existeix un usuari i la seva contrasenya a la BBDD 
	//Aquesta funció comprova si està activat el compte. Per fer-ho comprova que el camp 'codi_activació'  de la BBDD està en blanc. Quan un usuari és registra guardem les seves dades i un codi d'activació aleatori. Quan l'usuari activa el seu compte eliminem el codi d'activació, per tant si el codi no es blanc no està activat.
	public function exists_user_activat($user = '', $pass = '') {
		if(strcmp($user, '') == 0 && strcmp($pass, '') == 0){
			return false;
		}
		
		$conn=$this->crearConnexio();
		if(!$conn){
			return false;
		}

		$sql = "SELECT id_usuari, usuari, contrasenya FROM usuaris where usuari='".$user."' and codi_activacio=''";
		//echo $sql;
		$result = $conn->query($sql);
		//comparar contrasenyes bbdd amb la del formulari
		if(!$result){
			return false;
		}
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				if(strcmp($row["usuari"],$user)==0 && strcmp($row["contrasenya"],$pass)==0){
					$conn->close();	
					return true;
				}		
		}
		} 
			//echo "0 results";
			//echo "<h3 style='color:red;'>Usuari o contrasenya incorrectes</h3>";
			$conn->close();	
			return false;
		
				
	}
	
	

	//Funció per crear un nou usuari
	public function insert_user($user = '', $pass = '', $nom = '', $cognom1 = '', $cognom2 = '', $correu = '', $codi_activacio) {
		$conn=$this->crearConnexio();
		if(!$conn){
			return false;
		}

		$sql = "INSERT INTO webdaw.usuaris (id_usuari, usuari, contrasenya, nom, cognom1, cognom2, correu, codi_activacio) VALUES (NULL, '".$user."', '".$pass."', '".$nom."', '".$cognom1."', '".$cognom2."', '".$correu."', '".$codi_activacio."');";
		echo $sql;
		$result = $conn->query($sql);
		$conn->close();	
		//si es pot inserir retorna true, altrament false;
		return $result;
		
	}
	
	//Funció per activar un usuari
	//Quan un usuari és registra guardem les seves dades i un codi d'activació aleatori. Quan l'usuari activa el seu compte eliminem el codi d'activació, per tant si el codi no es blanc no està activat.
	public function activar_user($codi = '') {
		$conn=$this->crearConnexio();
		if(!$conn){
			return false;
		}
		$sql = "UPDATE usuaris SET codi_activacio = '' WHERE usuaris.codi_activacio = '".$codi."'";
		//echo $sql;
		$result = $conn->query($sql);
		$conn->close();	
		return $result;
		
	}
	
	//Funció per enviar un correu d'activació del compte a l'usuari registrat amb codi d'activació $codi.
	//Quan un usuari és registra guardem les seves dades i un codi d'activació aleatori. Quan l'usuari activa el seu compte eliminem el codi d'activació, per tant si el codi no es blanc no està activat.
	public function enviar_correu($codi = ''){
		$result = $this->get_correu_user($codi);
		$resultat = true;
		if(!$result){
				$resultat = false;
			}	
		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$resultat = $this->enviar_correu_usuari($row["correu"], $codi);
			if($resultat){
				$resultat = true;
			}
			else{
				$resulat = false;
			}
		}
		else{
			//echo "0 results";
			$resultat = false;
			}
		return $resultat;
	}
	
	//funció per obtenir el correu d'un usuari a partir del seu codi d'activació
	public function get_correu_user($codi = ''){
		$conn=$this->crearConnexio();
		if(!$conn){
			return false;
		}
		$sql = "Select usuaris.correu FROM webdaw.usuaris WHERE usuaris.codi_activacio = '".$codi."'";
		//echo $sql;
		$result = $conn->query($sql);
		$conn->close();	
		return $result;
	}	
		
	//Funció que crea el correu d'activació i l'envia.
	private function enviar_correu_usuari($correu = '', $codi = ''){
		echo "<br>Correu ". $correu;
		$para    = $correu;
        $asunto  = "Activar compte usuari DAW";
        $mensaje = "<hr>";
        $mensaje.= "<h2>Hola clicka al següent enllaç per activar el teu compte</h2><br>";
		$mensaje.= "<br /><br /><a href='http://dabin.cat/loginuser/activar_usuari_web.php?codi=".$codi."'>Activar compte usuari</a>";
        $mensaje.= "<hr>";
        		
		//A Dinahosting has d'utilitzar la capçalera 'From'. Aquest from ha de ser un correu vàlid del teu domini. 
        // Para enviar correo HTML, la cabecera Content-type debe definirse
        $cabeceras  = "MIME-Version: 1.0\n";
        $cabeceras .= "Content-type: text/html; charset=UTF-8\n";

        // Cabeceras adicionales
        $cabeceras .= "From: dabin@dabin.cat\n";
        $cabeceras .= "To: ".$correu."\n";
        $cabeceras .= "X-Mailer: PHP/" . phpversion();

        // Enviarlo
	    $ok = mail($para, $asunto, $mensaje, $cabeceras);
		
		if($ok){
			echo "<br>Correu enviat correctament";
			
		}else{
			echo "<br>Error al enviar el correu";
		}
		return true;		
		
	}	
		
		
}

?>