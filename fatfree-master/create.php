<?php 
echo "top of create form";
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
session_start();
// Change this to your connection info.
$host = 'localhost';
$user = 'root';
$db_password = '';
$db_name = 'jordanDB';
$isMessage = false;
$message = "";
// $password = $_GET['password2'];
// $f3->set('password','GET.password2');
$password = $f3->get('GET.password2');
echo $password . '<br><br>';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


if(isset($_GET["create"])) {
	echo "hello oodie: ";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo 'hello oodie<br>';
	if(isset($_GET["create"]))
	{
		if(empty($_GET["username2"]) || empty($_GET["password2"]))
		{
			$isMessage = true;
			$message = "Field is blank";

		}
		else
		{
            echo "top else statement";
			$query="INSERT INTO user (username,password) VALUES(:username, :password)";
			$statement= $conn->prepare($query);
			$statement->execute(
				array(
					':username'=> $_GET['username2'],
					':password'=>$hashed_password
				)
				);
                echo "mid else statement";
				$count= $statement->rowCount();
				if($_GET["password2"]==$_GET["confirm_password"])
				{header("location:login.php");}
				else
				{$isMessage = true;
					$message = "passwords do not match";
				}
				echo "end else statement";
		}
		
	}
	}
    
 catch(PDOException $error)
    {
    echo $error->getMessage();
    }
}

echo View::instance()->render('login.php');




?>