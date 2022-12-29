<?php

include ("../../init.php");
include ("../session.php");
use Models\Movies;

$booking_id = $_GET['movie_id']??null;

try {
    if(isset($movie)){
        $movie = new Movie('', '', '', '', '');
        $movie->setConnection($connection);
        $movie->getByMovieId($movie_id);
        $movie->deleteMovie();
        echo "<script>window.location.href='index.php?success=3';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}
?>