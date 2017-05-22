<?php

if (isset($_POST['login']) && isset($_POST['password'])) {
    echo(login($_POST['login'], $_POST['password']));
}

function login($login, $psw) {
    $config = parse_ini_file ($_SERVER['DOCUMENT_ROOT']."/config.ini", TRUE)["main_db"];
    $link = mysqli_connect($config["host"],$config["user"], $config["password"], $config["db_name"]);

    /* проверка соединения */
    if (mysqli_connect_errno()) {
        return "connection error";
    }

    $query = 'SELECT * FROM admins WHERE email = "' . $login . '" AND password = "' . $psw . '"LIMIT 1;';
    if ($result = mysqli_query($link, $query)) {
        if (mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['isLoggedAdmin'] = true;
            $_SESSION['adminData'] = mysqli_fetch_array($result);
            return "ok";
        } else {
            return "not found";
        }

    }

    mysqli_free_result($result);
    mysqli_close($link);
}

