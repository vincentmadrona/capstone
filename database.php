<?php 
  // Database connection settings
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "event_db";

  // Create connection to MySQL
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>