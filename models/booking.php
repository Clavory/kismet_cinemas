<?php
namespace Models;
use \PDO;

class Booking
{
    protected $id;
    protected $avail_tickets;
    protected $seat_number;
    protected $date;
	protected $time;
    protected $venue;       

    public function __construct($no_of_tickets_available, $ticket_number, $date, $time, $venue)
	{
		$this->avail_tickets= $avail_tickets;
		$this->seat_number= $seat_number;
		$this->date= $date;
		$this->time= $time;
		$this->venue= $venue;
	}

	public function getTicketId(){
		return $this->id;
	}

	public function getAvailableTicket(){
		return $this->avail_tickets;
	}

	public function getTicketNumber(){
		return $this->seat_number;
	}

	public function getDate(){
		return $this->date;
	}

	public function getTime(){
		return $this->time;
	}

	public function getVenue(){
		return $this->venue;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}
	
	public function getByTicketId($ticketid){
		try {
			$sql = 'SELECT * FROM tblbooking WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->id = $data['id'];
				$this->avail_tickets = $data['avail_tickets'];
				$this->seat_number = $data['seat_number'];
				$this->date = $data['date'];
				$this->time = $data['time'];
				$this->venue= $data['venue'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllBooking(){
        try {
			$sql = 'SELECT * FROM tblbooking';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
  
	public function addBooking(){
		try {
			$sql = "INSERT INTO tblbooking SET id=?, avail_tickets=?, seat_number=?, date=?, time=?, venue=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getTicketId(),
				$this->getAvailableTicket(),
				$this->getTicketNumber(),
				$this->getDate(),
				$this->getTime(),
				$this->getVenue()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
	
	public function updateBooking($avail_tickets, $seat_number, $date, $time, $venue)
	{
		try {
			$sql = 'UPDATE tblbooking= SET avail_tickets=?, seat_number=?, date=?, time=?, venue=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$avail_tickets, 
				$seat_number, 
				$date, 
				$time, 
				$venue,
				$this->getTicketId()
			]);
			$this->avail_tickets = $avail_tickets;
			$this->ticket_number = $ticket_number;
			$this->date = $date;
			$this->time = $time;
			$this->venue = $venue;	
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deleteBooking()
	{
		try {
			$sql = 'UPDATE tblbooking WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getTicketId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}