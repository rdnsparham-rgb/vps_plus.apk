<?php
header('Content-Type: application/json');

$API_TOKEN = "parham123"; // توکن انتخابی شما

// بررسی توکن از هدر Authorization
$headers = getallheaders();
if(!isset($headers['Authorization']) || $headers['Authorization'] !== "Bearer $API_TOKEN") {
    echo json_encode(["status"=>"error","message"=>"توکن نامعتبر"]);
    exit;
}

// فایل دیتابیس
$file = 'database.json';

// دریافت داده POST
$input = json_decode(file_get_contents('php://input'), true);
if(!isset($input['name'])) {
    echo json_encode(["status"=>"error","message"=>"نام ارسال نشده"]);
    exit;
}

$name = trim($input['name']);
if($name === "") {
    echo json_encode(["status"=>"error","message"=>"نام خالی است"]);
    exit;
}

// خواندن دیتابیس
$data = json_decode(file_get_contents($file), true);

// اضافه کردن کاربر جدید
$id = count($data) + 1;
$data[] = ["id"=>$id, "name"=>$name];

// ذخیره مجدد دیتابیس
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"success","message"=>"با موفقیت اضافه شد"]);
?>
