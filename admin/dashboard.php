<?php
session_start();
$userData = $_SESSION["adminData"];
?>

User id: <?= $userData["id"] ?> <br>
User name: <?= $userData["name"] ?> <br>
User email: <?= $userData["email"] ?> <br>
User phone: <?= $userData["phone"] ?> <br>