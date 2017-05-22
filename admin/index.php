<?php
session_start();
if ($_SESSION['isLoggedAdmin'] == false) {
    header("Location:/admin/login.html");
} else {
    header("Location:/admin/dashboard.php");
}
