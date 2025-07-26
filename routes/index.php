<?php 
require_once __DIR__ . "/../app/Controllers/ItemController.php"; 
require_once __DIR__ . "/../app/Controllers/AuthController.php"; 
use App\Controllers\ItemController;
use App\Controllers\AuthController;

$method = $_GET['method']; 

switch ($method) {
    case "login":
        $instance = new AuthController(); 
        
        $result = $instance->login($_POST); 
        break; 
    case "register":
        $instance = new AuthController(); 
        
        $result = $instance->register($_POST); 
        break; 

    case "logout":
        $instance = new AuthController(); 
        $result = $instance->logout($_POST); 
        break; 
    case "items":
        $instance = new ItemController(); 
        
        $result = $instance->index(); 
        break; 
    case "insertItem": 

        $instance = new ItemController(); 
        $result = $instance->insert($_POST); 
        break; 
        case "updateItem":     
    
            $instance = new ItemController(); 
            $result = $instance->update($_POST); 
            break; 
        case "deleteItem":     
       
            $instance = new ItemController(); 
            $result = $instance->delete($_POST); 
            break; 
    default:
        $result = []; 

}

echo ($result); 
exit;