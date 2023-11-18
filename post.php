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
      // SUCCESS: POSTS AVAILABLE IN DB
      // LOOP & DISPLAY DYNAMIC POSTS
      $output = "";
      while ($row = $result->fetch_assoc()) {
        $uid = $row['uidUser'];
        $title = $row['MovieTitle'];

        $output .= '
        <div class="col-12">
        <div class="cardP mb-3" id="' . $row['id'] . '">
          <div class="row g-0">
            <div class="col-md-4">
              <!-- Image -->
              <img src="' . $row['ImageURL'] . '" class="img-fluid rounded-start" style="object-fit: cover; height: 450px; width: 300px" alt="' . $row['MovieTitle'] . '">
            </div>
            <div class="col-md-5 p-2">
              <!-- Post Details -->
              <div class="nameDate">
                <h5 class="card-title">Title: ' . $row['MovieTitle'] . '</h5>
                <p class="card-title">' . $row['ReviewText'] . '</p>
                <p class="card-text">Image URL: ' . $row['ImageURL'] . '</p>

                <!-- Rating -->
                <div class="app-form-group">
                  <div class="mb-3">
                    <div class="rate" name="Rating">';

                      $rating = intval($row['Rating']);
                      for ($i = 5; $i >= 1; $i--) {
                        $checked = $i === $rating ? 'checked' : '';
                        $output .= '
                          <input type="radio" id="star' . $i . '" name="rating" value="' . $i . '" ' . $checked . ' disabled />
                          <label for="star' . $i . '" title="' . $i . ' stars">&#9733;</label>
                        ';
                      }

                    $output .= '
                    </div>
                  </div>
                </div>';
                                
            if (isset($_SESSION['userId'])) {
              $output .= '
                <div class="admin-btn mt-2">
                  <a href="editpost.php?id=' . $row['id'] . '" class="btn btn-secondary" id="bgbtn">Edit</a>
                  <a href="includes/deletepost.inc.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
                </div>
              ';
            }

            $output .= '            
                </div>
              </div>
            </div>
          </div>
        </div>';
      }
      echo $output;
    } else {
      echo "0 results";
    }
    // Close the database connection if needed
    $conn->close();
    ?>
  </div>
</main>
<?php 
  require "templates/footer.php"
?>
