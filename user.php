<?php

include ("db.php");

class User {
	private $name;
	private $email;
	private $veggie;
	private $password;
	private $id;

	function __construct( $data ) {
		//if $data is an array, object is created with user info
		if ( is_array( $data ) )
		{
			$this->name = $data["name"];
			$this->email = $data["email"];
			$this->veggie = $data["veggie"];
			$this->password = $data["password"];
		}
		//else $data is $id
		else
		{
			$this->id = $data;
			$this->fetchById ( $this->id );
		}


	}

	public function insert() {
		$db = DB::connect();

		$stmt = $db->prepare( "INSERT INTO user ( name, email, veggie, password ) VALUES( :name, :email, :veggie, :password )" );
		$stmt->execute( array(  ':name' => $this->name,
								':email' => $this->email,
								':veggie' => $this->veggie,
								':password' => $this->password
							 ) );
		$affectedRows = $stmt->rowCount();
		$this->id = $db->lastInsertId();
		return $this->id;
	}

	public function delete( ) {
		$db = DB::connect();

		$stmt = $db->prepare( "DELETE FROM user  WHERE id = :id" );
		$stmt->execute( array(  ':id' => $this->id
							 ) );
		$affectedRows = $stmt->rowCount();
		return TRUE;
	}

	public function update( ) {
		$db = DB::connect();

		$stmt = $db->prepare( "UPDATE user SET name=:name, email=:email, veggie=:veggie, password=:password WHERE id = :id" );
		$stmt->execute( array(  ':name' => $this->name,
								':email' => $this->email,
								':veggie' => $this->veggie,
								':password' => $this->password,
								':id' => $this->id
							 ) );
		$affectedRows = $stmt->rowCount();
		return TRUE;
	}

	public function fetchById( $id ) {
		$db = DB::connect();

		$stmt = $db->prepare( "SELECT * FROM user WHERE id = :id" );
		$stmt->execute( array(  
								':id' => $id
							 ) );
		if ($stmt->rowCount() == 1) {
			$data = $stmt->fetch();
			$this->name = $data["name"];
			$this->email = $data["email"];
			$this->veggie = $data["veggie"];
			$this->password = $data["password"];
		}

		
		return TRUE;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

  	public function __set($property, $value) {
		if (property_exists($this, $property)) {
		$this->$property = $value;
		}

		return $this;
	}

}

?>