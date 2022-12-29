<?php
namespace Models;
use \PDO;

class Payment
{
    protected $payment_id;
    protected $amount;
    protected $date;
    protected $time;     

    public function __construct($amount, $date, $time)
	{
		$this->amount= $amount;
		$this->date= $date;
		$this->time= $time;
	}

	public function getPaymentId(){
		return $this->payment_id;
	}

	public function getAmount(){
		return $this->amount;
	}

	public function getDate(){
		return $this->date;
	}

	public function getTime(){
		return $this->time;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}
	
	public function getByPaymentId($payment_id){
		try {
			$sql = 'SELECT * FROM tblpayment WHERE payment_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$payment_id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->payment_id = $data['payment_id'];
				$this->amount = $data['amount'];
				$this->date = $data['date'];
				$this->time = $time['time'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllPayment(){
        try {
			$sql = 'SELECT * FROM tblpayment';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
  
	public function addPayment(){
		try {
			$sql = "INSERT INTO tblpayment SET payment_id=?, amount=?, date=?, time=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getPaymentId(),
				$this->getAmount(),
				$this->getDate(),
				$this->getTime()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deletePayment()
	{
		try {
			$sql = 'UPDATE tblpayment WHERE payment_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getPaymentId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}