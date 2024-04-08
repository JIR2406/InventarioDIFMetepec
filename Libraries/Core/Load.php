<?php
// Configuracion carga de archivos

// Ensure controller name is in CamelCase
$controller = ucwords($controller);

// Define the file path for the controller
$controllerFile = "Controllers/" . $controller . ".php";

// Check if the controller file exists
if (file_exists($controllerFile)) {
    // Include the controller file
    require_once($controllerFile);

    // Create an instance of the controller
    $controller = new $controller();

    // Check if the requested method exists in the controller
    if (method_exists($controller, $method)) {
        // Call the method with any provided parameters
        $controller->{$method}($params);
    } else {
        // If the method doesn't exist, handle it with an Errors controller (you might want to customize this)
        require_once("Controllers/Errores.php");
    }
} else {
    // If the controller file doesn't exist, handle it with an Errors controller (you might want to customize this)
    require_once("Controllers/Errores.php");
}
?>