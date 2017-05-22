<?php
require_once "../mainDB.php";
$pdo = getMainDB();
$stmt = $pdo->query('SELECT id,name FROM olympiads;'); // после SELECT указать все поля, которые нужны для таблицы
$stmt->execute();
$olymps = $stmt->fetchAll(); // тут будет массив с ассоциативными массивами, которые содержат инфу о одной записи в бд

foreach ($olymps as $olymp){
    echo $olymp["id"]." : ".$olymp["name"]."<br>";
}