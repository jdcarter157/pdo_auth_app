<?php
session_start();
if(isset($_SESSION["username"]))
{
    echo'<h3> Login success,welcome '.$_SESSION["username"]."</h3>";
    echo '<br><br><a href="index.php">Logout </a>';
    $query="SELECT * FROM todo ";
			$statement= $conn->prepare($query);
			$statement->execute(
				array(
					'todoText'=> $_POST["todoText"],
					'todoTitle'=>$_POST["todoTitle"]
				)
				);
					header("location:login.php");
				
}else{
    header("location:index.php");
}
?>
<body>
    <p>
        result is 
    </p>
    <p id="demo">
        <div class="container">
            <div class="app">
              <h2>To DO List</h2>
            </div>
          </div>
          <form action='todo.php' method='post'>
            <input name='todoText' type="text" placeholder="Add new text...">
            <input name='todoTitle' type="text" placeholder="Add new title...">
            <button type="submit">&plus;</button>
          </form>

          <ul>
            <li>
              <input type="checkbox" onclick="taskComplete(this)" class="check">
              <input type="text" value=" " class="task" onfocus="getCurrentTask(this)" onblur="editTask(this)">
              <button onclick="removeTask(this)">delete</button>
            </li>
          </ul>
    </p>
    
    <script src="index.php"></script>

</body>