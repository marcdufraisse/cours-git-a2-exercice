<?php session_start();
require('config/config.php');
require('model/functions.fn.php');

/********************************
			PROCESS
********************************/

if(isset($_POST)) {
	if(isset($_POST['email']) && !empty($_POST['email'])
	&& isset($_POST['username']) && !empty($_POST['username'])
	&& isset($_POST['password']) && !empty($_POST['password'])){
		/* isEmailAvailable
			return :
				true if available
				false if not available
			$db -> 				database object
			$email -> 			field value : email
		*/
		$email_ok = isEmailAvailable($db, $_POST['email']);

		/* isUsernameAvailable
			return :
				true if available
				false if not available
			$db -> 				database object
			$username -> 			field value : username
		*/
		$username_ok = isUsernameAvailable($db, $_POST['username']);


		if ($email_ok == true && $username_ok == true) {
			/* userRegistration
				return :
					true for registration OK
					false for fail
				$db -> 				database object
				$username -> 		field value : username
				$email -> 			field value : email
				$password -> 		field value : password
			*/
			userRegistration($db, $_POST['username'], $_POST['email'], $_POST['password']);
			header('Location: login.php');
		}

		if (!$email_ok) {
			$error = 'Email indisponible';
		}

		if (!$username_ok) {
			$error = 'Username indisponible';
		}
	}
}

/******************************** 
			VIEW 
********************************/

include 'view/_header.php';
include 'view/register.php';
include 'view/_footer.php';
