<?php 
namespace App\Controllers; 
require_once __DIR__ . "/../Models/Item.php";
use App\Models\Item; 

class ItemController {

    public function index() {
        $itemModel = new Item(); 
        $output = $itemModel->all(); 

         return json_encode($output, JSON_UNESCAPED_UNICODE); 
    }
    
    public function insert($input) {
       
        $data = [
            "name" => $input['name'],
            'price' => $input['price'], 
            'description' => $input['description']
        ]; 
      
        $itemModel = new Item(); 
        $output = $itemModel->insert($data); 
 
        return json_encode($output, JSON_UNESCAPED_UNICODE); 
    }

    public function delete($input) {
        $item_id = $input['item_id']; 
      
        $itemModel = new Item(); 
        $result = $itemModel->delete($item_id); 

        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function update($input) {
       
        $data = [
            "id" => $input['id'], 
            "name" => $input['name'],
            'price' => $input['price'], 
            'description' => $input['description']
        ]; 

        $itemModel = new Item(); 
        $output = $itemModel->update($data); 
 
        return json_encode($output, JSON_UNESCAPED_UNICODE); 
    }
}