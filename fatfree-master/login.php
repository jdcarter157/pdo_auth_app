<?php
session_start();
if(isset($_SESSION["username"]))
{
    echo'<h3> Login success,welcome '.$_SESSION["username"]."</h3>";
    echo '<br><br><a href="ex.php">Logout </a>';

}
?>
<body>
    


</body>