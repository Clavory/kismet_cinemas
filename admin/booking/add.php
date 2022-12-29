<?php

include ("../../init.php");
include ("../session.php");
use Models\Booking;

$admin = new Booking('', '', '', '', '',);
$admin->setConnection($connection);
$admin_user = $admin->setUser($_SESSION['ticket_id']);

$template = $mustache->loadTemplate('admin/booking/add.mustache');
echo $template->render(compact('admin_user'));

try {
    if(isset($_POST['ticket_number'])){
        $ticket = new Booking($_POST['ticket_number'], $_POST['no_of_tickets_available'], $_POST['date'], $_POST['time'], $_POST['venue']);
        $ticket->setConnection($connection);
        $ticket_id = $ticket->getTicketId();
        $ticket_id= $ticket->addTicket();
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}