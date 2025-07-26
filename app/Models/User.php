<?php 
namespace App\Models;
require_once __DIR__ . "/Model.php";
use PDO; 

class User extends Model
{
    protected $table = "users";

      public function insert($input) {
        $output = [];
        $current_date = date('Y-m-d H:i:s');
  
        $stmt = $this->connect->prepare("INSERT INTO `users`
        (`name`, `username`, `password`, `created_at`, `updated_at`) 
        VALUES (:name, :username, :password, :created_at, :updated_at)");

        $stmt->bindParam('name', $input['name']);
        $stmt->bindParam('username', $input['username']);
        $stmt->bindParam('password', $input['password']);
        $stmt->bindParam('created_at', $current_date);
        $stmt->bindParam('updated_at', $current_date);

        $run = $stmt->execute();
       
        if (!$run) {
            $output['status'] = "error";
            $output['message'] = "پردازش اطلاعات با شکست روبرو شد.";
            return $output;
        }

        $output['status'] = "success";
        $output['message'] = "با موفقیت انجام شد.";
        $output['response'] = $this->connect->lastInsertId();

        return $output;
    }

    public function showByUsernmae($username) {
  
        $stmt = $this->connect->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam('username', $username);

        $run = $stmt->execute();

        if (!$run) {
            $output['status'] = "error";
            $output['message'] = "پردازش اطلاعات با شکست روبرو شد.";
            $output['response'] = [];
            return $output;
        }

        if ($stmt->rowCount() == 0) {
            $output['status'] = "error";
            $output['message'] = "اطلاعات یافت نشد";
            $output['response'] = [];
            return $output;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $output['status'] = "success";
        $output['message'] = "با موفقیت انجام شد.";
        $output['response'] = $row;

        return $output;
    }

    public function checkPassword($password) {

        $password = md5($password); 
        $stmt = $this->connect->prepare("SELECT * FROM users WHERE password = :password");
        $stmt->bindParam('password', $password);

        $run = $stmt->execute();

        if (!$run) {
            $output['status'] = "error";
            $output['message'] = "پردازش اطلاعات با شکست روبرو شد.";
            $output['response'] = [];
            return $output;
        }

        if ($stmt->rowCount() == 0) {
            $output['status'] = "error";
            $output['message'] = "اطلاعات یافت نشد";
            $output['response'] = [];
            return $output;
        }

        $row = $stmt(PDO::FETCH_ASSOC);

        $output['status'] = "success";
        $output['message'] = "با موفقیت انجام شد.";
        $output['response'] = $row;

        return $output;
    }
}
