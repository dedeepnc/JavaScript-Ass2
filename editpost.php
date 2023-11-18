<!-- HEADER.PHP -->
<?php 
  require "templates/header.php";
?>
<!-- Edit Post -->

<main class="container p-4 mt-3">
  <?php
  if (isset($_SESSION['userId']) && isset($_GET['id'])) {
    // Success: execute script
    require './includes/connect.inc.php';

    $id = $conn->real_escape_string($_GET['id']);
    $postId = intval($id);

    $sql = "SELECT id, uidUser, MovieTitle, ImageURL, ReviewText, Rating FROM tblPosts WHERE id=?;";
    $statement = $conn->prepare($sql);

    if (!$statement) {
      header("Location: ../post.php?error=sqlerror");
      exit();
    }

    $statement->bind_param("i", $postId);
    $statement->execute();

    $result = $statement->get_result();
    if (!$result) {
      header("Location: ../post.php?error=servererror");
      exit();
    }
    $row = $result->fetch_assoc();
  } else {
    header("location: ./index.php");
    exit();
  }
  ?>

  <!-- editpost.inc.php - Will process the data from this form-->
  <form action="includes/editpost.inc.php?id=<?php echo $postId ?>" method="POST">
    <h2>Edit Post</h2>
    <!-- DYNAMIC ERROR MESSAGES FOR EDITPOST -->
    <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] == 'emptyfields') {
        $errorMsg = "Please fill in all fields";
      } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "An internal server error has occurred - please try again later";
      }
      echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
    }
    ?>

    <div class="mb-3">
      <label for="imageurl" class="form-label">Image URL</label>
      <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['ImageURL'] ?>">
    </div>

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['MovieTitle'] ?>">
    </div>

    <div class="mb-3">
      <label for="comment" class="form-label">ReviewText</label>
      <textarea class="form-control" name="comment" rows="3" placeholder="Review"><?php echo $row['ReviewText'] ?></textarea>
    </div>

    <!-- Rating -->
    <div class="mb-3">
      <div class="rate" name="Rating">
        <input type="radio" id="star5" name="rating" value="5" <?php echo ($row['Rating'] == 5) ? 'checked' : ''; ?>/>
        <label for="star5" title="5 stars">&#9733;</label>

        <input type="radio" id="star4" name="rating" value="4" <?php echo ($row['Rating'] == 4) ? 'checked' : ''; ?>/>
        <label for="star4" title="4 stars">&#9733;</label>

        <input type="radio" id="star3" name="rating" value="3" <?php echo ($row['Rating'] == 3) ? 'checked' : ''; ?>/>
        <label for="star3" title="3 stars">&#9733;</label>

        <input type="radio" id="star2" name="rating" value="2" <?php echo ($row['Rating'] == 2) ? 'checked' : ''; ?>/>
        <label for="star2" title="2 stars">&#9733;</label>

        <input type="radio" id="star1" name="rating" value="1" <?php echo ($row['Rating'] == 1) ? 'checked' : ''; ?>/>
        <label for="star1" title="1 star">&#9733;</label>
      </div>
    </div>

    <button type="submit" name="edit-submit" class="btn btn-primary w-100" id="bgbtn">Edit</button>
  </form>
</main>

