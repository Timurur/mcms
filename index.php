<?php
session_start();
if ($_SESSION['isLoggedParticipant'] == false) {
    header("Location:/login.html");
} else {
    header("Location:/dashboard.php");
}