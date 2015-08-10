<?php

// echo 'aaaa';
require ( "user.php" );

// echo var_dump($_POST);

if (isset($_POST)) {
	echo $_GET['action'];
	if ( strcmp( $_GET['action'], 'newuser')  == 0) {
		$veggie = ($_POST['veggie']=='false'?0:1);
		$data = [
			"name" => $_POST['name'],
			"email" => $_POST['email'],
			"veggie" => $veggie, 
			"password" => $_POST['password']
		];

		$user = new User( $data );
		$lastId = $user->insert();
		echo 1;
	}

	else if ( strcmp( $_GET['action'], 'login') == 0 ) {
		$data = [
			"email" => $_POST['email'],
			"password" => $_POST['password']
		];

		$user = new User( $data );
		$success = $user->authAdmin();
		if ($success) {
			// if admin, set session with user id;
			session_start();
			$_SESSION['adminId'] = $user->id;
			echo 'Admin';
		}
		else {
			echo 'Not Admin';
		}
	}

	else if ( strcmp( $_GET['action'], 'islogged') == 0 ) {
		session_start();
		if (isset($_SESSION['adminId'])) {
			echo $_SESSION['adminId'];
		}
		else {
			echo 0;
		}
	}

	else if ( strcmp( $_GET['action'], 'fetchusers') == 0 ) {
		echo 'lalalal';
		session_start();
		if (isset($_SESSION['adminId'])) {
			echo User::fetchAll();
		}
		else {
			echo 0;
		}
		echo 'lalalalala';
	}
	// $user->name = "Lucas";
	// $user->update( );

	
	// $user2 = new User( 11 );
	// $user2->name = "Lucas";
	// $user2->update( );
	// echo $user2->name;


	// User::fetchAll();

}

?>

