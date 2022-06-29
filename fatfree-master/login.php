<?php
$host = 'localhost';
$user = 'root';
$db_password = '';
$db_name = 'jordanDB';
$isMessage = false;
$message = "";

echo "top of form ";


if (file_exists('vendor/autoload.php')) {
	// load via composer
	require_once('vendor/autoload.php');
	$f3 = \Base::instance();
} elseif (!file_exists('lib/base.php')) {
	die('fatfree-core not found. Run `git submodule init` and `git submodule update` or install via composer with `composer install`.');
} else {
	// load via submodule
	/** @var Base $f3 */
	$f3=require('lib/base.php'); }




    $db = new DB\SQL("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);

    $f3->set('db',$db);
    $username = $f3->get('GET.username'); 
    $password = $f3->get('GET.password');


    
       $f3->set("result", $f3->db->exec('select * from user where username=?', [$username]));
       if (empty($f3->get['result'])) {
        echo 'no dice, no matches, nothin';
       } else {
            $success = password_verify($password, $f3->get('result')[0]['password']);
            if ($success) {
                echo 'successful login';
            } else {
                echo 'you are bad';
       }
       }
    







?>
