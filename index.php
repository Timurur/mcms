<?php
session_start();
if (isset($_SESSION['participantData'])) {
    header("Location:/dashboard.php");
} else {
    header("Location:/login.html");
}