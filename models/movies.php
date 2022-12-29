<?php
namespace Models;
use \PDO;

class Movie
{
    protected $id;
    protected $movie_name;   
    protected $movie_duration;
	protected $movie_price;     
    protected $movie_type;
    protected $movie_date;

    public function __construct($id, $movie_name, $movie_duration, $movie_price, $movie_genre, $movie_date)
	{
        $this->movie_id= $movie_id;
		$this->movie_name= $movie_name;
		$this->movie_hour= $movie_hour;
		$this->movie_price= $movie_price;
		$this->movie_type= $movie_type;
		$this->movie_type= $movie_date;
	}

    public function getMovieId(){
		return $this->id;
	}

	public function getMovieName(){
		return $this->movie_name;
	}

	public function getMovieDuration(){
		return $this->movie_duration;
	}

	public function getMoviePrice(){
		return $this->movie_price;
	}

	public function getMovieType(){
		return $this->movie_genre;
	}

	public function getMovieDate(){
		return $this->movie_date;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}
	
	public function getByMovieId($id){
		try {
			$sql = 'SELECT * FROM tblmovie WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->id = $data['id'];
				$this->movie_name = $data['movie_name'];
				$this->movie_duration = $data['movie_duration'];
				$this->movie_price = $data['movie_price'];
				$this->movie_type = $data['movie_type'];
				$this->movie_date = $data['movie_date'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllMovies(){
        try {
			$sql = 'SELECT * FROM tblmovie';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
  
	public function addMovie(){
		try {
			$sql = "INSERT INTO tblmovies SET id=?, movie_name=?, movie_duration=?, movie_price=?, movie_genre=?, movie_date=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getMovieId(),
				$this->getMovieName(),
				$this->getMovieHour(),
				$this->getMovieType(),
				$this->getMovieDate()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
	
	public function updateMovie($id, $movie_name, $movie_duration, $movie_price, $movie_genre, $movie_date)
	{
		try {
			$sql = 'UPDATE tblmovie SET movie_name=?, movie_duration=?, movie_price=?, movie_genre=?, movie_date=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$id, 
				$movie_name, 
				$movie_duration, 
				$movie_price, 
				$movie_genre, 
				$movie_date,
				$this->getMovieId()
			]);
			$this->movie_name = $movie_name;
			$this->movie_duration = $movie_duration;
			$this->movie_price = $movie_price;
			$this->movie_genre = $movie_genre;
			$this->movie_date = $movie_date;		
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deleteMovie(){
		try {
			$sql = 'UPDATE tblmovieshow WHERE movie_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getMovieId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}