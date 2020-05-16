<?php
session_start();

require_once('settings.php');

$title = 'YetiCave';

if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['name'];
} else {
    $user_name = "";
}

// получение категорий из БД
$sql_category = "SELECT id, name, code_name FROM category";
$categories = sql_query_result($con, $sql_category);

// получение лотов из БД
$sql_lots = "SELECT lot.id, lot.name, lot.start_price as price, lot.img_link as url, lot.end_date as expire, category.name as category FROM lot LEFT JOIN category ON lot.categoryID = category.ID ORDER BY create_date DESC";
$lots = sql_query_result($con, $sql_lots);


//подключаем темплейты
$content = include_template('main.php',
    [
        //'adverts' => $adverts,
        'lots' => $lots,
        'categories' => $categories
    ]);

$layout = include_template('layout.php', 
    [
        'content' => $content,
        'title' => 'YetiCave',
        'user_name' => $user_name,
        'categories' => $categories
    ]);

print($layout);
