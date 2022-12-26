<?php
namespace Models;
use \PDO;

class Movie
{
    protected $movie_id;
    protected $title;   
    protected $cover_img;    
    protected $description;
    protected $duration;
    protected $date_showing;   
    protected $end_date;    
    protected $yt_link;    

    public function __construct($movie_id, $title, $cover_img='', $description='', $duration, $date_showing, $end_date, $yt_link='')
	{
        $this->movie_id= $movie_id;
		$this->title= $title;
		$this->cover_img= $cover_img;
		$this->description= $description;
		$this->duration= $duration;
		$this->date_showing= $date_showing;
		$this->end_date= $end_date;
		$this->yt_link= $yt_link;
	}

    public function getMovieId(){
		return $this->movie_id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getCoverImage(){
		return $this->cover_img;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getDuration(){
		return $this->duration;
	}

	public function getDateShowing(){
		return $this->date_showing;
	}

	public function getEndDate(){
		return $this->end_date;
	}

	public function getYoutubeLink(){
		return $this->yt_link;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}
	
	public function getByMovieId($movie_id){
		try {
			$sql = 'SELECT * FROM movies WHERE movie_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$movie_id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->movie_id = $data['movie_id'];
				$this->title = $data['title'];
				$this->cover_img = $data['cover_img'];
				$this->description = $data['description'];
				$this->duration = $data['duration'];
				$this->date_showing = $data['date_showing'];
				$this->end_date = $data['end_date'];
				$this->yt_link = $data['yt_link'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllMovies(){
        try {
			$sql = 'SELECT * FROM movies';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
  
	public function addMovie(){
		try {
			$sql = "INSERT INTO movies SET movie_id=?, title=?, cover_img=?, description=?, duration=?, date_showing=?,end_date=?, yt_link=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getMovieId(),
				$this->getTitle(),
				$this->getCoverImage(),
				$this->getDescription(),
				$this->getDuration(),
				$this->getDateShowing(),
				$this->getEndDate(),
				$this->getYoutubeLink(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
	
	public function updateMovie($movie_id, $title, $cover_img, $description, $duration, $date_showing, $end_date, $yt_link)
	{
		try {
			$sql = 'UPDATE movies SET title=?, cover_img=?, description=?, duration=?, date_showing=?,end_date=?, yt_link=? WHERE faculty_number=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$title, 
				$cover_img, 
				$description, 
				$duration, 
				$date_showing,
				$end_date,
				$yt_link,
				$this->getMovieId()
			]);
			$this->title = $title;
			$this->cover_img = $cover_img;
			$this->description = $description;
			$this->duration = $duration;
			$this->date_showing = $date_showing;
			$this->end_date = $end_date;
            $this->yt_link = $yt_link;		
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deleteMovie(){
		try {
			$sql = 'UPDATE movies WHERE movie_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getMovieId()
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