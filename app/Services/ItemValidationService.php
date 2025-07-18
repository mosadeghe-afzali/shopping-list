<?php
namespace App\services; 

class ItemValidationService {
    public static function insertItemRequest($input) {

        if(!isset($input['name']) || empty($input['name']) ) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'نام را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE); 
            exit;
        }
        

        if(!isset($input['price']) || empty($input['price']) ){
            echo json_encode([
                'status' => 'error', 
                'message' => 'قیمت را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!isset($input['description']) || empty($input['description']) ) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'توضیحات را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!is_string($input['name'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'نام را حروف وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!is_string($input['description'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'توضیحات را حروف وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    
        if(!is_numeric($input['price'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'قیمت را عدد وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    public static function updateItemRequest($input) {

        if(empty($input['id'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'شناسه آیتم را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!isset($input['name']) || empty($input['name']) ) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'نام را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE); 
            exit;
        }

        if(!isset($input['price']) || empty($input['price']) ){
            echo json_encode([
                'status' => 'error', 
                'message' => 'قیمت را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!isset($input['description']) || empty($input['description']) ) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'توضیحات را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!is_string($input['name'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'نام را حروف وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!is_string($input['description'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'توضیحات را حروف وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if(!is_numeric($input['price'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'قیمت را عدد وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    public static function deleteItemRequest($input) {
        if(empty($input['item_id'])) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'شناسه آیتم را وارد نمایید.',
                'response' => []
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}