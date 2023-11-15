<?php
// 1. CHECK USER IS LOGGED IN & SUBMITTED FORM CORRECLTY (otherwise redirect them to posts.php)
session_start();
if (isset($_POST['edit-submit']) && isset($_SESSION['userId'])) {
  // 2. CONNECT TO DB & STORE FORM/OTHER VARIABLES
  require './connect.inc.php';

  $uid = $_SESSION['userId'];
  $postId = $_GET['id'];
  $title = $_POST['MovieTitle'];
  $imageUrl = $_POST['ImageURL'];
  $comment = $_POST['ReviewText'];
  $rating = $_POST['Rating'];


  // 4. PREPARED STATEMENT FOR UPDATE
  // Template
  $sql = "UPDATE tblPosts SET uidUser=?, MovieTitle=?, ImageURL=?, ReviewText=?, Rating=? WHERE id=?;";
  $statement = $conn->stmt_init();
  if (!$statement->prepare($sql)) {
    header("Location: ../editpost.php?Id=$postId&error=sqlerror");
    exit();
  }


  // Binding & execution
  $statement->bind_param("sssssi", $uid, $title, $imageUrl, $comment, $rating, $postId);
  $statement->execute();
  if ($statement->error) {
    header("Location: ../editpost.php?id=$postId&error=servererror");
    exit();
  }
  // SUCCESS EDIT:
  header("Location: ../post.php?postid=$postId&edit=success");
  exit();


  $statement->close();
  $conn->close();
} else {
  header("Location: ../post.php?error=forbidden");
  exit();
}

