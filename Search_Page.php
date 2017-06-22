<!DOCTYPE html>
<html>
<style>
form {
   
}

input[type=text]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    box-shadow: 0px 10px 5px #888888;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    font-size: 15px;
    text-align: center;
    font-family: sans-serif;
}

label {
    cursor: pointer;
    font-family:  Arial ;
}
button:hover {
    opacity: 1.0;
}


.container {
    padding: 20px;
}
</style>

<body>
<form = action = "<?php $_PHP_SELF ?>" method = "GET">
  <div class="container">
  <label><b>Eoogle</b></label>
    <input type="text" placeholder="Search" style="width: 400px; height: 50px" name="name" required>     
    <button type="submit" style="width: 100px; height: 50px;">Search</button>

  </div>

  <div class="container" style="background-color:#f2f1f2">
    
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


$buff = parseInput($name);

switch ($buff) {
    case 0:
        # code...
        findEmployee($conn, $name);
        break;
    
    case 1:
        # code...
        findEmployeeByEmpNo($conn, $name);
        break;

    case 2:
        # code...
        findDepartment($conn, $name);
        break;
}


function findEmployee($conn, $name)
{
    # code...
    $sql_query = "SELECT * FROM employees
                    WHERE (first_name LIKE '{$name}' OR last_name LIKE '{$name}') AND 
                    emp_no IN (
                    SELECT emp_no
                    FROM salaries
                    ORDER BY salary DESC)";

    $result = $conn->query($sql_query);

    echo $result;
    if ($result->num_rows > 0) {
        $i = 0;
        while ($row = $result->fetch_assoc() && $i < 5){
           echo "First name: " . $row['first_name'] . "&nbsp &nbsp &nbsp  Last name: " . $row['last_name'] . " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Gender: " . $row['gender'] . "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Emp_id : " . $row['emp_no'] . "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Hire Date: " . $row['hire_date'] ;
            echo "<br>";
            $i++;
        }
    }
    else {
       echo "Error performing query " . $conn->error;
       
    }
    mysqli_close($con);
}

function findEmployeeByEmpNo($conn, $name)
{
    # code...
    $sql_query = "SELECT * FROM employees
                    WHERE emp_no = $name";
    $result = $conn->query($sql_query);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
           echo "First name: " . $row['first_name'] . "&nbsp &nbsp &nbsp  Last name: " . $row['last_name'] . " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Gender: " . $row['gender'] . "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Emp_id : " . $row['emp_no'] . "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Hire Date: " . $row['hire_date'] ;
            echo "<br>";
        }
    }
    else {
       echo "Error performing query " . $conn->error;
       
    }
    mysqli_close($con);
}

function findDepartment($conn, $name)
{
    # code...
    $sql_query = "SELECT * FROM departments
                    WHERE dept_no = '{$name}'";
    $result = $conn->query($sql_query);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) {
            # code...
            echo "its department of ".$row['dept_name'];
        }
    }
    else {
       echo "Error performing query " . $conn->error;
       
    }
    mysqli_close($con);

}
function parseInput(string $value)
{
    # code...
    if ( ord($value) < 123 && ord($value) > 96)
    {
        if ( $value[1]>123 || $value[1]<96 ) {
            # code...
            return 2;
        }
    
        return 0;
    }
    else
    {
        return 1;
    }
}

?>                                                          
