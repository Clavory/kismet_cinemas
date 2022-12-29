<?php
namespace Models;
use \PDO;

class Customer
{
    protected $id;
    protected $c_first_name;
    protected $c_last_name;
    protected $customer_email;
    protected $customer_mobile;
    protected $customer_password;
    protected $customer_address;    

    public function __construct($c_first_name, $c_last_name, $customer_email, $customer_password, $customer_mobile='', $customer_address='')
	{
		$this->c_first_name= $c_first_name;
		$this->c_last_name= $c_last_name;
		$this->customer_email= $customer_email;
        $this->customer_password= $customer_password;
		$this->customer_mobile= $customer_mobile;
		$this->customer_address= $customer_address;
	}

	public function getCustomerId(){
		return $this->id;
	}

	public function getFirstName(){
		return $this->c_first_name;
	}

	public function getLastName(){
		return $this->c_last_name;
	}

	public function getCustomerPassword(){
		return $this->customer_password;
	}

	public function getCustomerEmail(){
		return $this->customer_email;
	}

	public function getContactNumber(){
		return $this->customer_mobile;
	}

	public function getCustomerAddress(){
		return $this->customer_address;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}
	
	public function getByCustomerId($id){
		try {
			$sql = 'SELECT * FROM tblcustomer WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->id = $data['id'];
				$this->c_first_name = $data['c_first_name'];
				$this->c_last_name = $data['c_last_name'];
				$this->customer_password = $data['customer_password'];
				$this->customer_email = $data['customer_email'];
				$this->customer_mobile = $data['customer_mobile'];
				$this->customer_address = $data['customer_address'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllCustomers(){
        try {
			$sql = 'SELECT * FROM tblcustomer';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

  
	public function addCustomer(){
		try {
			$sql = "INSERT INTO tblcustomer SET id=?, c_first_name=?, c_last_name=?, customer_password=?, customer_email=?,customer_mobile=?, customer_address=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getCustomerId(),
				$this->getFirstName(),
				$this->getLastName(),
                $this->getCustomerPassword(),
				$this->getCustomerEmail(),
				$this->getContactNumber(),
				$this->getCustomerAddress(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
	
	public function updateCustomer($c_first_name, $c_last_name, $customer_email, $customer_mobile, $customer_address)
	{
		try {
			$sql = 'UPDATE tblcustomer SET c_first_name=?, c_last_name=?, customer_password=?, customer_email=?, customer_mobile=?, customer_address=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$c_first_name, 
				$c_last_name, 
				$customer_email, 
				$customer_mobile,
                $customer_password,
				$customer_address,
				$this->getCustomerId()
			]);
			$this->c_first_name = $c_first_name;
			$this->c_last_name = $c_last_name;
			$this->customer_email = $customer_email;
			$this->customer_mobile = $customer_mobile;
            $this->customer_password = $customer_password;
            $this->customer_address = $customer_address;			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deleteCustomer(){
		try {
			$sql = 'UPDATE tblcustomer WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getCustomerId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}