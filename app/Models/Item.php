<?php
namespace App\Models;
require_once __DIR__ . "/Model.php";

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

}