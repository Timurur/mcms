<?php

if (isset($_POST['login']) && isset($_POST['password'])) {
    echo(login($_POST['login'], $_POST['password']));
} else {
    echo "arguments haven't been send";
}

function login($login, $psw) {
    $config = parse_ini_file ($_SERVER['DOCUMENT_ROOT']."/config.ini", TRUE)["main_db"];
    $link = mysqli_connect($config["host"],$config["user"], $config["password"], $config["db_name"]);

    if (mysqli_connect_errno()) {
        return "connection error";
    }

    $query = 'SELECT * FROM participants WHERE login = "' . $login . '" AND password = "' . $psw . '"LIMIT 1;';
    if ($result = mysqli_query($link, $query)) {
        if (mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['isLoggedParticipant'] = true;
            $_SESSION['participantData'] = mysqli_fetch_array($result);
            return "ok";
        } else {
            return "not found";
        }

        mysqli_free_result($result);
    } else {
        return "db error";
    }

    mysqli_close($link);
}