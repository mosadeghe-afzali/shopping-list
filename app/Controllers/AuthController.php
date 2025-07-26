<?php
namespace App\Controllers; 
session_start();

require_once __DIR__ . "/../Models/User.php";

use App\Models\User; 


class AuthController {
    public function login($input) {
     
        $userModel = new User(); 
        $user = $userModel->showByUsernmae($input['username']); 
  
        if($user['status'] == 'error') {
            return json_encode($user, JSON_UNESCAPED_UNICODE); 
        }
        $userData = $user['response']; 

        if($userData['password'] != md5($input['password'])) {
            return json_encode([
                'status' => 'error', 
                'message' => 'نام کاربری یا کلمه عبور اشتباه است.',
                'response' => []
            ]); 
            exit;
        }

        $_SESSION['username'] = $input['username']; 
        $_SESSION['user_id'] = $userData['id']; 
        return json_encode($user, JSON_UNESCAPED_UNICODE); 
    }

    public function logout($input) {

        $_SESSION['username'] = ""; 
        $_SESSION['user_id'] = ""; 
        $_SESSION = []; 
        echo  json_encode([
            "status" =>  "success",
            "message" => "باموفقیت انجام شد.", 
            "response" => []
        ], JSON_UNESCAPED_UNICODE); 
    }

    public function register($input) {
        $data = [
            'name' => $input['name'],
            'password' => md5($input['password']),
            'username' => $input['username']
        ];
   
        $userModel = new User(); 

        $user = $userModel->showByUsernmae($input['username']); 

        if($user['status'] ==  'success') {
            echo  json_encode([
                "status" =>  "error",
                "message" => "نام کاربری قبلا ثت شده است.", 
                "response" => []
            ], JSON_UNESCAPED_UNICODE); 
            exit; 
        }

        $output = $userModel->insert($data); 
        $_SESSION['username'] = $input['username']; 
        $_SESSION['user_id'] = $output['response']; 
        return json_encode($output, JSON_UNESCAPED_UNICODE); 
    }
}