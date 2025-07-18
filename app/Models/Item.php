<?php
namespace App\Models;
require_once __DIR__ . "/Model.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);


class Item extends Model
{
    protected $table = "items";
    private $nmae;
    private $price;
    private $description;

    public function all() {
        $stmt = $this->connect->prepare("SELECT * FROM items ORDER BY created_at DESC");
        $run = $stmt->execute();

        if (!$run) {
            $output['status'] = "error";
            $output['message'] = "پردازش اطلاعات با شکست روبرو شد.";
            $output['response'] = [];
            return $output;
        }

        if ($stmt->rowCount() == 0) {
            $output['status'] = "success";
            $output['message'] = "اطلاعات یافت نشد";
            $output['response'] = [];
            return $output;
        }

        $row = $stmt->fetchAll();

        $output['status'] = "success";
        $output['message'] = "با موفقیت انجام شد.";
        $output['response'] = $row;

        return $output;
    }

    public function insert($input)
    {
        $output = [];
        $current_date = date('Y-m-d H:i:s');
  
        $stmt = $this->connect->prepare("INSERT INTO `items`
        (`name`, `price`, `description`, `created_at`, `updated_at`) 
        VALUES (:name, :price, :description, :created_at, :updated_at)");

        $stmt->bindParam('name', $input['name']);
        $stmt->bindParam('price', $input['price']);
        $stmt->bindParam('description', $input['description']);
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

    public function update($input)
    {
        $output = [];
        $current_date = date('Y-m-d H:i:s');

        $stmt = $this->connect->prepare("UPDATE `items` 
        SET name=:name,price=:price,description=:description,updated_at=:updated_at WHERE id=:id");

        $stmt->bindParam('id', $input['id']);
        $stmt->bindParam('name', $input['name']);
        $stmt->bindParam('price', $input['price']);
        $stmt->bindParam('description', $input['description']);
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

    public function delete($id)
    {
        $output = [];
  
        $stmt = $this->connect->prepare("DELETE FROM `items` WHERE  id = :id");

        $stmt->bindParam('id', $id);

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
}