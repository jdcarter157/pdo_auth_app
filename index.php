<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Authentication</title>
</head>
<body>
<form action="login.php" method="POST">
				<label for="username">
					
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
				
				</label>
				<input type="password" name="password" placeholder="Password" id="password">
				<button name='login'>Login</button>
                
</form>
<form action="create.php" method="POST">
    <label for="username">
					
    </label>
    <input type="text" name="username2" placeholder="Username" id="username2" required>
    <label for="password">
                    
    </label>
    <input type="password" name="password2" placeholder="Password" id="password2">
    <input type="password" name="confirm_password" placeholder="Confirm Password"
    id="confirm_password">
    <button name="create">Create New User</button>
</form>
</body>
</html>

<?php 
session_start();
// Change this to your connection info.
$host = 'localhost';
$user = 'root';
$db_password = '';
$db_name = 'jordanDB';
$isMessage = false;
$message = "";
if(isset($_POST["login"])) {
	echo "hello";
}
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo 'hello oodie<br>';
	if(isset($_POST["login"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$isMessage = true;
			$message = "Field is blank";

		}
		else
		{
			$query="SELECT * FROM user WHERE username= :username AND password = :password";
			$statement= $conn->prepare($query);
			$statement->execute(
				array(
					'username'=> $_POST["username"],
					'password'=>$_POST["password"]
				)
				);
				$count= $statement->rowCount();
				if($count>0)
				{$_SESSION["username"]=$_POST["username"];
					header("location:login.php");}
				else
				{$isMessage = true;
					$message = "User doesn't exist";
				}
		}
		
	}
	}
    
 catch(PDOException $error)
    {
    echo $error->getMessage();
    }




    
?>