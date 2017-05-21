<?php
function getMainDB(){
    $config = parse_ini_file ($_SERVER['DOCUMENT_ROOT']."/config.ini", TRUE)["main_db"];

    $dsn = "mysql:host=$config[host];dbname=$config[db_name];charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $config["user"], $config["password"], $opt);

    return $pdo;
}