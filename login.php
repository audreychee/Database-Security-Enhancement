<?php
	$Msg = null;
	session_start();
	
	if (isset($_SESSION['fname'])){ // detect if logged in, then do LOGOUT
		
		if (!empty($_SESSION['error'])){  // Display multiple login error message
			$Msg = $_SESSION['error'];	
		
		} else {	// Display logout message
			$Msg = "<p style='color:green'><strong>You have successfully logged out.</strong></p>";
		}
		
		// renew or delete current session_id from database
		if (isset($_SESSION['session_id']) && (isset($_POST['logout_button']) || $_SESSION['timesup']) && $_SESSION['session_id'] != 'none'){
			
			if ($_SESSION['timesup']){		// Display session expired message
				$Msg = "<p style='color:red'>Your session has expired.</p>";
			}
			
			$conn = @mysqli_connect("localhost","root","") or die("Unable to connect to database.");
			@mysqli_select_db($conn,"cos20031_proj") or die ("Unable to select database");
			$sesID = $_SESSION['session_id'];
            
			$delSes = "UPDATE userlist SET session_id='none' WHERE session_id='$sesID'";
            
            // Execute query
            @mysqli_query($conn, $delSes);
           
			@mysqli_close($conn);
		}
		// remove all sessions value and destroy session
		unset($_SESSION['fname']);
		unset($_SESSION['lname']);
		unset($_SESSION['email']);
		unset($_SESSION['pass']);
		unset($_SESSION['id']);
		unset($_SESSION['error']);
		unset($_SESSION['time']);
		unset($_SESSION['timesup']);
		session_destroy();
		
	}else { 	// detect if login button is pressed, run the LOGIN procedures
		$conn = @mysqli_connect("localhost","root","") or die("Unable to connect to database.");
		@mysqli_select_db($conn,"cos20031_proj") or die ("Unable to select database");
				
        if (isset($_POST["login_button"])){
			
            $id = $_POST['email'];
			$pass = hash('sha256',$_POST["password"]);
			
            $getUser = "SELECT * FROM userlist WHERE email='$id' AND pass='$pass'";
            
            // Execute query
            $valid = @mysqli_query($conn, $getUser);
			
			// Check if Email input has been registered
			$row = 0;
			if ($valid){
				$row = @mysqli_num_rows($valid);
			}
						
			// If query result contains > 0 rows, means the given email and password matched to a record in DB = LOGIN SUCCESS
			if ($row > 0){ 	
				
                $dbUserData = @mysqli_fetch_array($valid);
					
				// Obtain user data and assign to session variables to maintain state
                $_SESSION['fname'] = $dbUserData['fname'];
                $_SESSION['lname'] = $dbUserData['lname'];
                $_SESSION['email'] = $dbUserData['email'];
                $_SESSION['pass'] = $dbUserData['pass'];
                $_SESSION['id'] = $dbUserData['id'];
                $_SESSION['session_id'] = $dbUserData['session_id'];
                $_SESSION['time'] = $dbUserData['time'];
                
                $id = $_SESSION['id'];
                
                // Reset session_id if previous login session did not logout for a long time
                if ((time()-$_SESSION['time'])>300 || (time()-$_SESSION['time'])<-300){
                    $dbUserData['session_id'] = "none";
                }
                
                // --- ADVANCE FEATURE ---
                // prevent multiple logins
                if ($dbUserData['session_id'] == "none"){
                    $sessionID = session_id();
                    $time = time();
                    
                    $updateSession = "UPDATE userlist SET session_id='$sessionID',time='$time' WHERE id='$id'";
                    
                    // Execute query
                    @mysqli_query($conn, $updateSession);
                    
                    $_SESSION['session_id'] = $sessionID;
                    $_SESSION['time'] = $time;
                }
                
                header("Location: dashboard.php");	// login successful, redirect to dashboard
				
			} else {
				$Msg = "<p style='color:red'><strong>Invalid username or password!</strong></p>";
			}
			@mysqli_free_result($valid);
		}
		@mysqli_close($conn);
		
	}
?>

<!DOCTYPE html>

	<!-- Description:  -->
	<!-- Author:  -->
	<!-- Date:  -->

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Login Page"/>
	<meta name="keywords" content="login"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<title>Sign In</title>
	<link rel="icon" href="image/logo.png"/>
</head>
<body class="register">

	<form method="post" action="login.php">
		<img src="image/logo.png" alt="Logo"  width="100%" height="100%"/>
		<h1>Sign In</h1>
		<fieldset>
			<table id="login">
				<tr>
				  <td><input type="text" name="email" placeholder="Email*" id="email"/></td>
				</tr>
				<tr>
				  <td><input type="password" name="password" placeholder="Password*"/></td>
				</tr>
			</table>
		</fieldset>
		<div>
			<input type="reset" value="Reset"/>
			<input type="submit" value="Login" name="login_button"/>
		</div>
	</form>
	<div>
		<?php echo $Msg; ?>
		<p>Haven't register?</br><a href="register.php">REGISTER</a></p>
	</div>
</body>
</html>