<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Todo_list";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
/*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>todo list</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<div>

</div>
<body> 
      <div class="container">
      
       <form action="db.php" method="post" class="form-group"> 
    task : <input type="text" name="task"> <input type="submit" name="submit" class="btn btn-primary">
    </form>
        <?php 
        
    $sql1 = "SELECT * FROM list";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
    // output data of each row 
        echo "<table class='table'>";
        echo "<tr>";
        echo "<th> task </th>";
        echo "<th> time </th>";
        echo "<th> action </th>";
        echo "</tr>";
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'. $row["message"].'</td>';
        echo '<td>'. $row["time"].'</td>';
        echo '<td> <a href="db.php?id='. $row["id"].'"> <button class="btn btn-danger">Delete </button> </a> </td>';
        echo '</tr>';
    }
    
   
        
        
} else {
    echo "data not found";
}
      echo "</table>";
    ?>
    </div>
</body>
</html>


<?php
$task = "";
$sql = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $task = $_POST["task"];
    if(isset($_POST["submit"])){
        if(!empty($task)){
          $sql = "INSERT INTO list (message) VALUES ('".$task."')";
            if($conn->query($sql) === TRUE){
                echo "New record created successfully";
               header("Location: http://localhost/Todo-list/db.php");
            }else{
                echo "Error : ".$conn->error;
            }
        }
    }
    
    
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $task = $_GET["id"];
        if(!empty($task)){
          $sql = "DELETE FROM list WHERE id =".$task;
            if($conn->query($sql) === TRUE){
                echo "New record created successfully";
               header("Location: http://localhost/Todo-list/db.php");
            }else{
                echo "Error : ".$conn->error;
            }
        }
    }
    
}

?>