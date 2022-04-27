<?php 

Class Database
{

	private $con;
	

	//construct
	function __construct()
	{

		$this->con = $this->connect();
	}

	//connect to db
	private function connect()
	{
		try
		{
		    $username='root';
		    $password='';
		    
			$connection = new PDO('mysql:host=localhost;dbname=hezbook',$username, $password);
			return $connection;

		}catch(PDOException $e)
		{
			echo $e->getMessage();
			
			die;
		}

		return false;

	}

	//write to database
	public function write($query,$data )
	{

		$con = $this->connect();
		$statement = $con->prepare($query);
		$check = $statement->execute($data);

		if($check)
		{
			return true;
		}else {
			return false;
		}

		

	}

	//read from database
	public function read($sql,$log )
	{

		$con = $this->connect();
		$statement = $con->prepare($sql);
		$check = $statement->execute($log);

		if($check)
		{
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result) > 0)
			{
				return $result;
			}
			return false;
		}

		return false;

	}
	
	
	public function get_user($userid)
	{

		$con = $this->connect();
		$arr['userid'] = $userid;
		$query = "select * from users where userid = :userid limit 1";
		$statement = $con->prepare($query);
		$check = $statement->execute($arr);

		if($check)
		{
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result) > 0)
			{
				return $result[0];
			}
			return false;
		}

		return false;

	}
	

	public function generateuserid($max)
	{

		$rand = "";
		$randCount = rand(4,$max);
		for ($i=0; $i < $randCount; $i++) { 
			
			$r = rand(0,9);
			$rand .= $r;
		}

		return $rand;
	}
}

?>


