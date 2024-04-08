<?php
class Views
{
    function getView($controller, $view, $data = "")
    {
        $controller = get_class($controller);
        if ($controller == "Home") {
            $view = "Views/" . $view . ".php";
        } else {
            $view = "Views/" . $controller . "/" . $view . ".php";
        }

        // Check if the file exists before including it
        if (file_exists($view)) {
            require_once($view);
        } else {
            // Handle the case where the file doesn't exist (customize as needed)
            echo "Error: View file not found - " . $view;
        }
    }
}

?>