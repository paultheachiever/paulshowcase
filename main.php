<?php
// Retrieve POST data from the form submission

$NAME = $_POST['NAMES'];
$PHONE = $_POST['PHONE'];
$EMAIL = $_POST['EMAIL'];
$DATEIN = $_POST['DATEIN'];
$DATEOUT = $_POST['DATEOUT'];
$GUESTS = $_POST['GUESTS'];
$ROOMS = $_POST['ROOMS'];

// Create a new MySQLi connection to the database
$con = new mysqli("localhost", "root", "", "hotel");

// Check if the connection to the database was successful
if ($con->connect_error) {
    // If the connection failed, stop the script and print the error
    die("Connection failed: " . $con->connect_error);
}

// Prepare the SQL query to insert the data into the UNIT table
$sql = "INSERT INTO reservations (NAMES, PHONE, EMAIL, DATEIN, DATEOUT, GUESTS, ROOMS) VALUES ('$NAME','$PHONE','$EMAIL','$DATEIN','$DATEOUT','$GUESTS','$ROOMS')";

// Execute the SQL query
$result = $con->query($sql);

// Check if the query was successful
if ($result) {
    // If the query was successful, output a JavaScript alert and redirect to 1register.php
    echo "<script>
            alert('You have successfully booked your reservations ');
            window.location.href = 'apk hotel.html';
          </script>";
} else {
    // If there was an error with the query, print the error
    echo "Error: " . $sql . "<br>" . $con->error;
}

// Close the database connection
$con->close();
?>
