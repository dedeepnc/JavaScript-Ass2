<!-- HEADER.PHP -->
<?php 
  require "templates/header.php";
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>
<!-- Post -->

<main class="container p-4 bg-light mt-3">
  <div class="row">

    <?php
    // DELETEPOST ERRORS
    if (isset($_GET['error'])) {
      // specific error types
      if ($_GET['error'] == "forbidden") {
        $errorMsg = "Access denied - please submit the form correctly";
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
      } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "Internal server error has occurred - please try again later";
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
      }
    } elseif (isset($_GET['post']) && $_GET['post'] == "success") {
      echo '<div class="alert alert-success" role="alert">Post created!</div>';
    } elseif (isset($_GET['edit']) && $_GET['edit'] == "success") {
      echo '<div class="alert alert-success" role="alert">Post edited!</div>';
    } elseif (isset($_GET['delete']) && $_GET['delete'] == "success") {
      echo '<div class="alert alert-success" role="alert">Post deleted!</div>';
    }

    // Connect to the database (replace with your database connection code)
    require './includes/connect.inc.php';
    // Declare SQL & execute
    $sql = "SELECT id, uidUser, MovieTitle, ImageURL, ReviewText, Rating FROM tblPosts";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $uid = $row['uidUser'];
        $title = $row['MovieTitle'];
    ?>

        <div class="col-12">
          <div class="cardP mb-3" id="<?php echo $row['id']; ?>">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?php echo $row['ImageURL']; ?>" class="img-fluid rounded-start" style="object-fit: cover; height: 450px; width: 300px" alt="<?php echo $row['MovieTitle']; ?>">
              </div>
              <div class="col-md-5 p-2">
                <div class="admin-btn">
                  <a href="editpost.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary mt-2" id="bgbtn">Edit</a>
                  <a href="includes/deletepost.inc.php?id=<?php echo $row['id']; ?>" class="btn btn-danger mt-2">Delete</a>
                </div>
                <div class="nameDate">
                <h5 class="card-title">Title: <?php echo $row['MovieTitle']; ?></h5>
                <h5 class="card-title"><?php echo $row['ReviewText']; ?></h5>
                <p class="card-text"><?php echo $row['ImageURL']; ?></p>
                <p class="card-text"><?php echo $row['Rating']; ?></p>
                </div>
        
                <?php
                if (isset($_SESSION['userId'])) {
                  ?>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>

    <?php
      }
    } else {
      echo "0 results";
    }
    // Close the database connection if needed
    $conn->close();
    ?>

  </div>
</main>


