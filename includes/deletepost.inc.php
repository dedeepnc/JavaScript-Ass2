<?php
session_start();
if(isset($_SESSION['userId']) && isset ($_GET['id'])){
    // 1. connect to db + store variables
    require './connect.inc.php';
    $postId = $conn->real_escape_string($_GET['id']);
    // 2. prepared statement (5 steps) for DELETE
    // Prepared statements - 5 to 6 (READ) steps
      // 2.1. Placeholder SQL
    $sql = "DELETE FROM tblPosts WHERE id=?;";
      // 2.2. Init prepared statement
    $statement = $conn->stmt_init();
      // 2.3. Preparing SQL to DB & testing it
    if(!$statement->prepare($sql)){
      header("Location: ../post.php?id=$postId&error=sqlerror");
      exit();
    }
      // 2.4. Binding the data to the statement
    $statement->bind_param("i", $postId);
    // 5. Execution of the prepared statement
    $statement->execute();
    if($statement->error){
      header("Location: ../post.php?id=$postId&error=servererror");
      exit();
    }

    // 3. on success, redirect to posts page

    header("Location: ../post.php?id&delete=success");
    exit();


}else{
  header("Location: ../signup.php?error=forbidden");
  exit();
  //when user not login
}

