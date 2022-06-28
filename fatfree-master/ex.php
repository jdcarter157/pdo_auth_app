<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login screen</title>
</head>
<body>
<form  method="GET">
				<label for="username">
					
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
				
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<button name='login'>Login</button>
                
</form>
<form  method="GET">
    <label for="username"></label>
    <input type="text" name="username2" placeholder="Username" id="username2" required>
    <label for="password"></label>
    <input type="password" name="password2" placeholder="Password" id="password2" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password"
    id="confirm_password" required>
    <button name="create">Create New User</button>
</form>
</body>
</html>

<?php 
// FatFree framework
require_once("vendor/autoload.php");
require_once("create.php");

if (file_exists('vendor/autoload.php')) {
	// load via composer
	require_once('vendor/autoload.php');
	$f3 = \Base::instance();
} elseif (!file_exists('lib/base.php')) {
	die('fatfree-core not found. Run `git submodule init` and `git submodule update` or install via composer with `composer install`.');
} else {
	// load via submodule
	/** @var Base $f3 */
	$f3=require('lib/base.php');
}


// $f3 = require ("fatfree/lib/base.php"); 
$f3->set('DEBUG', 1);

// MySql settings
$db= new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=jordanDB',
    'root',
    ''
);
$f3->set('DB',$db);

session_start();
// Change this to your connection info.
$host = 'localhost';
$user = 'root';
$db_password = '';
$db_name = 'jordanDB';
$isMessage = false;
$message = "";
// $password = $_GET['password'];
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

if(isset($_GET["password"])){$password = $_GET['password'];
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	//  echo $hashed_password;


if(isset($_GET["login"])) {
	echo "hello";
}
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo 'hello oodie<br>';
	if(isset($_GET["login"]))
	{
		if(empty($_GET["username"]) || empty($_GET["password"]))
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
					'username'=> $_GET["username"],
					'password'=>$hashed_password
				)
				);
				$count= $statement->rowCount();
                if(password_verify($password, $hashed_password)) {
				if($count>0)
				{$_SESSION["username"]=$_GET["username"];
					header("location:login.php");}
				else
				{$isMessage = true;
					$message = "User doesn't exist";
				}
		}
    }
		
	}
		}

    
 catch(PDOException $error)
    {
    echo $error->getMessage();
    }
}



    
?>