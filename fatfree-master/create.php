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

$db = new DB\SQL("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);

$f3->set('db',$db);
$username = $f3->get('GET.username2'); 
$password = $f3->get('GET.password2');
$confirm_password= $f3->get('GET.confirm_password');



	if($password==$confirm_password)
	{	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$f3->set("result", $f3->db->exec('INSERT INTO user (username,password) VALUES(?,?)', [$username,$hashed_password]));

		header("location:home.php");
}







?>