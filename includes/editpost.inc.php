<?php
session_start();
if (isset($_POST['edit-submit']) && isset($_SESSION['userId'])) {
  require './connect.inc.php';

  $uid = $_SESSION['userId'];
  $postId = $_GET['id'];
  $title = $_POST['title'];
  $imageUrl = $_POST['imageurl'];
  $comment = $_POST['comment'];
  $rating = $_POST['rating']; 

  $sql = "UPDATE tblPosts SET uidUser=?, MovieTitle=?, ImageURL=?, ReviewText=?, Rating=? WHERE id=?;";
  $statement = $conn->prepare($sql);

  if (!$statement) {
    header("Location: ../editpost.php?id=$postId&error=sqlerror");
    exit();
  }

  $statement->bind_param("sssssi", $uid, $title, $imageUrl, $comment, $rating, $postId);
  $statement->execute();

  if ($statement->error) {
    header("Location: ../editpost.php?id=$postId&error=servererror");
    exit();
  }

  header("Location: ../post.php?postid=$postId&edit=success");
  exit();

  $statement->close();
  $conn->close();
} else {
  header("Location: ../post.php?error=forbidden");
  exit();
}
?>
