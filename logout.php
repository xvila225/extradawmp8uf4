<?php
session_start();

//comprova si la sessió està iniciada
if(!isset($_SESSION)|| !isset($_SESSION['ready'])) {
	exit("<h1>403 Forbidden</h1>Aquesta pàgina requereix registre1.");
}
elseif(!$_SESSION['ready']) {
	exit("<h1>403 Forbidden</h1>Aquesta pàgina requereix registre2.");
}

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

//redirigim la pàgina a l'inici
header('Location: index.php');

?>