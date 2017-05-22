<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
    <title>Admin dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .Header {

            width:100%;
            text-align: center;

        }

    </style>
</head>
<body>
<div class="Header">
    <h1>MCMS Admin Access</h1>
</div>
<div style="text-align: center">
    <button onclick="location.href='createOl.php'">
        Add olympiad
    </button>
</div>

</body>


=======
<?php
session_start();
$userData = $_SESSION["adminData"];
?>

User id: <?= $userData["id"] ?> <br>
User name: <?= $userData["name"] ?> <br>
User email: <?= $userData["email"] ?> <br>
User phone: <?= $userData["phone"] ?> <br>
>>>>>>> refs/remotes/origin/olympiad-creation
