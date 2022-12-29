<?php
include ("../init.php");
session_start();
use Models\Admin;

if(!isset($_SESSION['admin_id'])){
    echo "<script>window.location.href='../admin-login.php';</script>";
    exit();
}

$admin = new Admin('', '', '');
$admin->setConnection($connection);
$admin_user = $admin->setUser($_SESSION['admin_id']);


$template = $mustache->loadTemplate('admin/dashboard.mustache');
echo $template->render(compact('admin_user'));