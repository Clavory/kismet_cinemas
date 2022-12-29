<?php

include ("../../init.php");
include ("../session.php");
use Models\Booking;

$booking_id = $_GET['ticket_id']??null;

try {
    if(isset($faculty_number)){
        $booking = new Booking('', '', '', '', '', '', '', '', '', '');
        $booking->setConnection($connection);
        $booking->getByBookingId($booking_id);
        $booking->deleteBooking();
        echo "<script>window.location.href='index.php?success=3';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}
?>