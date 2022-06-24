<?php 
session_start();
// Change this to your connection info.
$host = 'localhost';
$user = 'root';
$db_password = '';
$db_name = 'jordanDB';
$isMessage = false;
$message = "";
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


if(isset($_POST["create"])) {
	echo "hello oodie: ";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo 'hello oodie<br>';
	if(isset($_POST["create"]))
	{
		if(empty($_POST["username2"]) || empty($_POST["password2"]))
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
					':username'=> $_POST['username2'],
					':password'=>$hashed_password
				)
				);
                echo "mid else statement";
				$count= $statement->rowCount();
				if($_POST["password2"]==$_POST["confirm_password"])
				{header("location:login.php");}
				else
				{$isMessage = true;
					$message = "passwords do not match";
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