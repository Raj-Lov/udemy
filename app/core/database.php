<?php

// Database configuration

class Database {
   private function connect() {
      $str = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;
      return new PDO($str, DBUSER, DBPASS);
   }

  
	public function query($query,$data = [],$type = 'object')
	{
		$con = $this->connect();

		$stm = $con->prepare($query);
		if($stm)
		{
			$check = $stm->execute($data);
			if($check)
			{
				if($type == 'object')
				{
					$type = PDO::FETCH_OBJ;
				}else{
					$type = PDO:: FETCH_ASSOC;
				}

				$result = $stm->fetchAll($type);

				if(is_array($result) && count($result) > 0)
				{
					return $result;
				}
			}
		}

		return false;
	}

	public function create_tables(){
		//Users table
		$query = "
					CREATE TABLE IF NOT EXISTS `users` (
			`id` int(11) NOT NULL,
			`username` varchar(100) NOT NULL,
			`email` varchar(100) NOT NULL,
			`password` varchar(255) NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `id` (`id`),
			KEY `email` (`email`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

		";

		$this->query($query);
	}
}