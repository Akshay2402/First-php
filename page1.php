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

<form = action = "<?php $_PHP_SELF ?>" method = "GET">
  <div class="container">

    <label><b>Search a employee</b></label>
    <input type="text" placeholder="Enter employee name" name="name" required>     
    <button type="submit">Search</button>
    
  </div>

  <div class="container" style="background-color:#f1f1f1">
    
  </div>
</form>

</body>
</html>

<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$name = $_GET["name"];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM employees
    WHERE first_name LIKE '%{$name}%' OR last_name LIKE '%{$name}%'");

while ($row = mysqli_fetch_array($result))
{
        echo $row['first_name'] . " " . $row['last_name'] . " " . $row['gender'] . " " . $row['emp_no'] . " " . $row['hire_date'] ;
        echo "<br>";
}
    mysqli_close($con);

?>
