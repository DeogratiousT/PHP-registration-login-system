<?php
	session_start(); 
	$username = "";
	$email = "";
	$errors = array();

	//connecting to the database
	$db = mysqli_connect('localhost','root','','registration');

	//If the register button is clicked
	if (isset($_POST['register'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password1 = mysqli_real_escape_string($db, $_POST['password1']);
		$password2 = mysqli_real_escape_string($db, $_POST['password2']);

		//ensure all fields are filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password1)) {
			array_push($errors, "Password is required");
		}

		if ($password1 != $password2) {
			array_push($errors, "The two passwords do not match");
		}

		//if there are no errors, save user to the database
		if (count($errors) == 0) {
			
			$sql = "INSERT INTO users(username, email, password) VALUES('$username','$email','$password1')";
			mysqli_query($db, $sql);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Welcome user $username";
			header('location: home.php'); //redirecting to the homepage
		}
	}


	//log the user in from the login page
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		//ensure all fields are filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0 ) {
			
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result = mysqli_query($db, $query);
			if (mysqli_num_rows($result) == 1) {
				//log user in
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Welcome user $username";
				header('location: home.php'); //redirect to home page
			} else{
				array_push($errors, "The username/password combination do not exist");
			}
		}
	}


	//logout
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: index.php');
	}


 ?>