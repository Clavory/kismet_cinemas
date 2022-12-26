<?php
namespace Models;
use \PDO;

class Booking
{
    protected $booking_id;
    protected $first_name;
    protected $last_name;
    protected $contact_number;
	protected $qty;
    protected $date_of_book; 
    protected $time;      

    public function __construct($first_name, $last_name='', $contact_number='', $qty, $date_of_book, $time)
	{
		$this->first_name= $first_name;
		$this->last_name= $last_name;
		$this->contact_number= $contact_number;
		$this->qty= $qty;
		$this->date_of_book= $date_of_book;
		$this->time= $time;
	}

	public function getBookingId(){
		return $this->booking_id;
	}

	public function getFirstName(){
		return $this->first_name;
	}

	public function getLastName(){
		return $this->last_name;
	}

	public function getContactNumber(){
		return $this->contact_number;
	}

	public function getDateOfBook(){
		return $this->date_of_book;
	}

	public function getQuantity(){
		return $this->qty;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}
	
	public function getByBookingId($booking_id){
		try {
			$sql = 'SELECT * FROM booking WHERE booking_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$booking_id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->booking_id = $data['booking_id'];
				$this->first_name = $data['first_name'];
				$this->last_name = $data['last_name'];
				$this->contact_number = $data['contact_number'];
				$this->qty = $data['qty'];
				$this->date_of_book = $data['date_of_book'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllBooking(){
        try {
			$sql = 'SELECT * FROM booking';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
  
	public function addBooking(){
		try {
			$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO booking SET booking_id=?, first_name=?, last_name=?, contact_number=?, qty=?, date_of_book=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getBookingId(),
				$this->getFirstName(),
				$this->getLastName(),
				$this->getContactNumber(),
				$this->getQuantity(),
				$this->getDateOfBook()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
	
	public function updateBooking($first_name, $last_name, $contact_number, $qty, $date_of_book)
	{
		try {
			$sql = 'UPDATE booking SET first_name=?, last_name=?, contact_number=?, qty=?, date_of_book=? WHERE booking-id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
				$last_name, 
				$contact_number,
				$qty,
				$date_of_book,
				$this->getBookingId()
			]);
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->contact_number = $contact_number;
			$this->qty = $qty;
			$this->date_of_book = $date_of_book;	
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deleteBooking()
	{
		try {
			$sql = 'UPDATE booking SET status=2 WHERE booking_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getBookingId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function handleUpload($fileObject){
		try {
			$target_dir = '../../public/img/';

			$file_type = $_FILES['image_path']['type'];
			$allowed = array("image/jpeg", "image/gif", "image/png");
			if(!in_array($file_type, $allowed)) {
				$error_message = 'error';
				return $error_message;
			}
			else{
				if (is_uploaded_file($fileObject['tmp_name'])) {
					$target_file_path = $target_dir . date("Y-m-dh-i-s") . $fileObject['name'] ;
					$save_file_path = date("Y-m-dh-i-s") . $fileObject['name'] ;
					if (move_uploaded_file($fileObject['tmp_name'], $target_file_path)) {
						return [
							'picture_path' => $target_file_path,
							'save_path' => $save_file_path
						];
					}
				}
			}
		} catch (Exception $e) {
			error_log($e->getMessage());
			return false;
		}
	}
}