<?php
require ( "user.php" );

if (isset($_POST['name'])) {
	$data = [
		"name" => $_POST['name'],
		"email" => $_POST['email'],
		"veggie" => $_POST['veggie'], 
		"password" => $_POST['password']
	];

	$user = new User( $data );
	$lastId = $user->insert();
	$user->name = "Lucas";
	$user->update( );
	$user2 = new User( 11 );
	$user2->name = "Lucas";
	$user2->update( );
	echo $user2->name;


}

?>

