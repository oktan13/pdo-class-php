<?php

require_once 'Database/Database.php';

$db = new Database();

// Добавить запись в бд
$addRow = $db->execute("INSERT INTO `people` SET `name`='Артем', `surname`='Петров', `age`='15'");

// Получить данные из бд
$rowList = $db->query("SELECT * FROM `people`");
print_r($rowList);
