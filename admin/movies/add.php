<?php

include ("../../init.php");
include ("../session.php");
use Models\Movies;

$admin = new Movies('', '', '', '', '');
$admin->setConnection($connection);
$admin_user = $admin->setUser($_SESSION['movie_id']);

$template = $mustache->loadTemplate('admin/movies/add.mustache');
echo $template->render(compact('admin_user'));

try {
    if(isset($_POST['movie_name'])){
        $movies = new Booking($_POST['movie_name'], $_POST['movie_hour'], $_POST['movie_type'], $_POST['movie_date']);
        $movies->setConnection($connection);
        $movies_id = $movies->getMoviesId();
        $movies_id= $movies->addMovie();
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}