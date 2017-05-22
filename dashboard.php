<?php
session_start();
$userData = $_SESSION["participantData"];
?>

User id: <?= $userData["id"] ?> <br>
User name: <?= $userData["name"] ?> <br>