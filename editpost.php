<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
<!-- Edit Post -->

<main class="container p-4 mt-3">
  <?php
  if (isset($_SESSION['userId']) && isset($_GET['id'])) {
    // SUCCESS: exeute script
    //1. Connect to db + store the id in a variable (sanitise id)
    require './includes/connect.inc.php';

    // Store our POST form data under local variables
    $id = $conn->real_escape_string($_GET['id']);
    $postId = intval($id);


    //2.Prepared statements to select bt ID ("where")
    //NOTE: because its READ - we have 6 steps
    //1.
    $sql = "SELECT id, uidUser, MovieTitle, ImageURL, ReviewText, Rating FROM tblPosts WHERE id=?;";


    // 2. Init prepared statement
    $statement = $conn->stmt_init();

    // 3. Preparing SQL to DB & testing it
    if (!$statement->prepare($sql)) {
      header("Location: ../post.php?=error=sqlerror");
      exit();
    }

    // 4. Binding the data to the statement
    $statement->bind_param("i", $postId);
    $statement->execute();

    // Check the result to see if there was a match = DUPLICATE
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
  <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="POST">
    <h2>Edit Post</h2>
    <!-- DYNAMIC ERROR MESSAGES FOR EDITPOST -->
    <?php
    if (isset($_GET['error'])) {
      // error=emptyfields
      if ($_GET['error'] == 'emptyfields') {
        $errorMsg = "Please fill in all fields";
      }
      // error=sqlerror || error=servererror
      else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "An internal server error has occurred - please try again later";
      }
      // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
      echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
    }
    ?>




    <!-- 2. IMAGE URL -->
    <div class="mb-3">
      <label for="imageurl" class="form-label">Image URL</label>
      <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['ImageURL'] ?>">
    </div>

    <!-- 1. TITLE -->
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['MovieTitle'] ?>">
    </div>

    <!-- 3. COMMENT SECTION -->
    <div class="mb-3">
      <label for="comment" class="form-label">ReviewText</label>
      <textarea class="form-control" name="comment" rows="3" placeholder="Review"><?php echo $row['ReviewText'] ?></textarea>
    </div>


    <!-- 6. SUBMIT BUTTON -->
    <button type="submit" name="edit-submit" class="btn btn-primary w-100" id="bgbtn">Edit</button>
  </form>
</main>


<!-- FOOTER.PHP -->
