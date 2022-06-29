<?php 
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
$host = 'localhost';
$user = 'root';
$db_password = '';
$db_name = 'socialmedia';
$isMessage = false;
$message = "";

$db = new DB\SQL("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $db_password);

$f3->set('db',$db);

$feed_text=$f3->get('GET.feed');

    $f3->set("result", $f3->db->exec('INSERT INTO post (content) VALUES(?)', [$feed_text]));

   




?>
<form action='add_post.php' method="GET">
    <label for="feed">New Post</label>
    <input type="text" id="feed" name="feed"><br><br>
    <input type="submit" value="Submit">
</form>