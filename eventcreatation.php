<?php

$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "auth"; 


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $event_title = $_POST["event_title"];
    $event_description = $_POST["event_description"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $event_duration = $_POST["event_duration"];
    $event_location = $_POST["event_location"];

    
    $sql = "INSERT INTO events (title, description, date, time, duration, location) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $event_title, $event_description, $event_date, $event_time, $event_duration, $event_location);

   
    if ($stmt->execute()) {
        echo "<h2>New Event Created Successfully</h2>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

 
    $stmt->close();
} 
