<?php
session_start();
if (isset($_SESSION['adminData'])) {
    header("Location:/admin/dashboard.php");
} else {
    header("Location:/admin/login.html");
}
