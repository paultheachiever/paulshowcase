<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hotel";


$conn = new mysqli($host, $user, $password, $database);

if($conn -> connect_error){
    die(json_encode(["error"=>"db error"]));

}

if(!isset($_GET['PHONE'])){
    die(json_encode(["error"=>"no phone number added"]));

}

$PHONE = $_GET['PHONE'];
$sql = "SELECT *FROM reservations WHERE PHONE = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $PHONE);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $reservations = $result->fetch_assoc();
    echo json_encode($reservations);
} else {
    echo json_encode(["error" => "No reservation found"]);
}

$stmt->close();
$conn->close();

?>