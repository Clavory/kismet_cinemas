<?php
include ("../init.php");
session_start();
use Models\Faculty;

if(!isset($_SESSION['faculty_number']) || $_SESSION['faculty_type'] != 1){
    echo "<script>window.location.href='../faculty-login.php';</script>";
    exit();
}

$admin = new Faculty('', '', '', '', '', '', '', '', '', '3');
$admin->setConnection($connection);
$admin_user = $admin->setUser($_SESSION['faculty_number']);


$template = $mustache->loadTemplate('admin/dashboard.mustache');
echo $template->render(compact('admin_user'));