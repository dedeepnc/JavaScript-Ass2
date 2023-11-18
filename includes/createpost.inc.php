<?php 
session_start();
if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
  require './connect.inc.php'; // Make sure this includes your database connection

  $uid = $_SESSION['userId'];
  $postId = $_SESSION['id'];
  // Store form data to local variables
  $title = $_POST['MovieTitle'];
  $imageUrl = $_POST['ImageURL'];
  $comment = $_POST['ReviewText'];
  $rating = $_POST['Rating'];

  // Validation: You may want to enable this input validation for data integrity

  // INSERT DATA into POSTS using prepared statements (5 steps) 
  // Templating
  $sql = "INSERT INTO tblPosts(id, uidUser, MovieTitle, ImageURL, ReviewText, Rating) VALUES (NULL, ?, ?, ?, ?, ?)";
  $statement = $conn->stmt_init();

  if(!$statement->prepare($sql)){
    header("Location: ../createpost.php?error=sqlerror");
    exit();
  }

  // Execution
  $statement->bind_param("sssss", $uid, $title, $imageUrl, $comment, $rating);
  $statement->execute();

  if($statement->error){
    header("Location: ../createpost.php?error=servererror");
    exit();
  } 

  // SUCCESSFUL SUBMISSION:
  header("Location: ../post.php?post=success");
  exit();
} else {
  header("Location: ../createpost.php?error=forbidden");
  exit();
}
?>
