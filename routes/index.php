<?php 
require_once __DIR__ . "/../app/Controllers/ItemController.php"; 
use App\Controllers\ItemController;

$method = $_GET['method']; 

switch ($method) {
    case "items":
        $instance = new ItemController(); 
        
        $result = $instance->index(); 
        break; 
    case "insertItem": 
        // parse_str(implode('&', array_slice($argv, 1)), $params); 

        $instance = new ItemController(); 
        $result = $instance->insert($_POST); 
        break; 
 
    default:
        $result = []; 

}

echo ($result); 
exit;