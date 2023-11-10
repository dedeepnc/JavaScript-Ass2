<?php 
  // 1. DATABASE CONNECTION
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "moviemania";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("<h4 style='color: red'>Connection failed: " . $conn->connect_error . "</h4>");
  }
?>