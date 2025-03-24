<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UNITCODE = $_POST['UNITCODE'];

    // Database connection
    $con = new mysqli("localhost", "root", "", "orders");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT UNITCODE, UNITNAME FROM UNIT WHERE UNITCODE = ?");
    $stmt->bind_param("s", $UNITCODE);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unit Details</title>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 18px;
                text-align: left;
                a
            }
            th, td {
                padding: 10px;
                border: 1px solid black;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <fieldset>
            <legend>UNIT DETAILS</legend>
            
            <?php
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<table>";
                echo "<tr><th>UNITCODE</th><th>UNITNAME</th></tr>";
                echo "<tr><td>" . htmlspecialchars($row['UNITCODE']) . "</td><td>" . htmlspecialchars($row['UNITNAME']) . "</td></tr>";
                echo "</table>"
               ;
               
            } else {
                echo "<p>No results found.</p>";
            }
            ?>
<a href="main.html" class="btn-home">Home</a>
        </fieldset>
    </body>
    </html>

    <?php
    $stmt->close();
    $con->close();
}
?>
