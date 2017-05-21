<?php
require_once "../mainDB.php";

if (isset($_POST['login']) && isset($_POST['password'])) {
    echo(login($_POST['login'], $_POST['password']));
} else {
    echo "arguments haven't been send";
}

function login($login, $psw) {

    $pdo = getMainDB();

    $stmt = $pdo->prepare('SELECT * FROM participants WHERE login = ? AND password = ? LIMIT 1');
    $stmt->execute(array($login,$psw));

    if($result = $stmt->fetch()){
        session_start();
        $_SESSION['participantData'] = $result;
        return "ok";
    } else {
        return "not found";
    }
}