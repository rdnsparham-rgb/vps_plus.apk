<?php
// فایل دیتابیس
$file = 'data.json';

// گرفتن داده POST
$input = json_decode(file_get_contents('php://input'), true);
if(!isset($input['name'])) {
    echo "نام ارسال نشده!";
    exit;
}

$name = $input['name'];

// خواندن دیتابیس
$data = json_decode(file_get_contents($file), true);

// اضافه کردن داده جدید
$id = count($data) + 1;
$data[] = array("id" => $id, "name" => $name);

// ذخیره مجدد دیتابیس
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo "با موفقیت اضافه شد!";
?>
