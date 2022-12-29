<?php
namespace Models;
use \PDO;

class Auth
{
    protected $admin_id;
    protected $customer_id;
    protected $admin_password;
    protected $customer_password;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function adminLogin($admin_username, $admin_password){
        $sql = 'SELECT * FROM tbladmin WHERE admin_username=? AND admin_password=?';
		$statement = $this->connection->prepare($sql);
		$statement->execute([
				$admin_username,
                $admin_password
		]);
        $row = $statement->fetch();
        return $row;
    }

    public function userLogin($customer_email, $customer_password){
        $sql = 'SELECT * FROM tblcustomer WHERE customer_email=? AND customer_password=?';
		$statement = $this->connection->prepare($sql);
		$statement->execute([
				$customer_email,
                $customer_password
		]);
        $row = $statement->fetch();
        return $row;
    }
    
}   