<!DOCTYPE html>
<html>
<style>
form {
    border: 100px solid #f1f1f1;
}

input[type=text]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
	
}

button:hover {
    opacity: 0.8;
}


.container {
    padding: 20px;
}
</style>

<body>

<h2>Know about your Employees </h2>

<form action="<?php $_PHP_SELF?>" method="POST">
  

  <div class="container">
    <label><b>Search a employee</b></label>
    <input type="text" placeholder="Enter employee" name="uname" required>

   
        
    <button type="submit" >Search</button>
    
  </div>

  <div class="container" style="background-color:#f1f1f1">
    
  </div>
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "root";//write your password here
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "Connected successful to $dbname</br>"; 
}

$sql = "SELECT first_name,last_name FROM employees WHERE first_name ='".$_POST['uname']."'" ;
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        echo $row["first_name"]." ".$row["last_name"]."</br>";
    }
}else {
    echo "Error performing query " . $conn->error;
   
}
$conn->close();
?> 
</body>
</html>
