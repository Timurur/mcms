<?php
session_start();
if (isset($_POST["olympId"]) &&
    isset($_SESSION["adminData"]) && ($_SESSION["adminData"]["creating_olymps"] || $_SESSION["adminData"]["redacting_olymps"])) {

    require_once "../mainDB.php";
    $pdo = getMainDB();

    $stmt = $pdo->prepare('SELECT * FROM olympiads WHERE id = ?');
    $stmt->execute([$_POST["olympId"]]);

    if($result = $stmt->fetch()){
        $stmt = $pdo->prepare('SELECT * FROM tasks WHERE olymp_id = ?');
        $stmt->execute([$_POST["olympId"]]);

        $result["tasks"] = $stmt->fetchAll();

        echo json_encode($result);
    } else {
        echo "not found";
    }
}
