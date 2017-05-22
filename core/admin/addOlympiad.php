<?php

session_start();
if (isset($_POST["olympData"]) &&
    isset($_SESSION["adminData"]) && ($_SESSION["adminData"]["creating_olymps"] || $_SESSION["adminData"]["redacting_olymps"])) {
    $olympiad = json_decode($_POST["olympData"]);

    require_once "../mainDB.php";
    $pdo = getMainDB();

    $stmt = $pdo->prepare('INSERT INTO olympiads(name,grade,refresh_time,refresh_SQL_request,start_time,finish_time) 
    VALUES (:name,:grade,:refresh_time,:refresh_SQL_request,:start_time,:finish_time)');
    $values = [
        ":name" =>                $olympiad->name,
        ":grade" =>               $olympiad->grade,
        ":refresh_time" =>        $olympiad->refresh_time,
        ":refresh_SQL_request" => $olympiad->refresh_SQL_request,
        ":start_time" =>          $olympiad->start_time,
        ":finish_time" =>         $olympiad->finish_time
    ];

    $stmt->execute($values);

    $olympId = $pdo->lastInsertId();
    foreach($olympiad->tasks as $task){
        $stmt = $pdo->prepare("INSERT INTO tasks(olymp_id,task_id,isOpenAnswer,TEX_code,task_variables,variants) 
        VALUES ($olympId,:task_id,:isOpenAnswer,:TEX_code,:task_variables,:variants)");
        $values = [
            ":task_id" =>           $task->task_id,
            ":isOpenAnswer" =>      $task->isOpenAnswer,
            ":TEX_code" =>          $task->TEX_code,
            ":task_variables" =>    json_encode($task->task_variables),
            ":variants" =>          json_encode($task->variants)
        ];
        $stmt->execute($values);
    }
}