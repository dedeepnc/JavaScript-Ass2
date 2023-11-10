<?php 
  session_start();
  if(isset($_SESSION['userId']) && isset($_GET['id'])){
    // 1. connect to db + store variables
    require './connect.inc.php';
    $id = $conn->real_escape_string($_GET['id']);

    // 2. prepared statement (5steps) for DELETE
    $sql = "DELETE FROM posts WHERE id=?;";
    $statement = $conn->stmt_init();
    if(!$statement->prepare($sql)){
      header("Location: ../post.php?id=$id&error=sqlerror");
      exit();
    }

    $statement->bind_param("i", $id);
    $statement->execute();
    if($statement->error){
      header("Location: ../post.php?id=$id&error=servererror");
      exit();
    }
    // 3. on success, redirect to posts page
    header("Location: ../post.php?id=$id&delete=success");
    exit();


  } else {
    header("location: ../signup.php?error=forbidden");
    exit();
  }




?>