 <?php
$servername = "localhost";
$username = "root";
$password = "mrunal123";
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
	echo "Connected successful to $dbname"; 
}

$sql = "SELECT first_name,last_name FROM employees";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
    	echo $row["first_name"]." ".$row["last_name"]."</br>";
 	}
}else {
    echo "Error creating table: " . $conn->error;
   
}

$conn->close();
?>
