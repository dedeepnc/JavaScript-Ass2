  <!-- HEADER.PHP -->
  <?php
  require "templates/header.php"
  ?>
  <!-- Create Post -->
  <form action="./includes/createpost.inc.php" method="POST">
    <div class="background">
      <div class="container-about">
        <div class="screen">
          <div class="screen-header">
            <div class="screen-header-left">
              <div class="screen-header-button close"></div>
              <div class="screen-header-button maximize"></div>
              <div class="screen-header-button minimize"></div>
            </div>
            <div class="screen-header-right">
              <div class="screen-header-ellipsis"></div>
              <div class="screen-header-ellipsis"></div>
              <div class="screen-header-ellipsis"></div>
            </div>
          </div>
          <div class="screen-body">
            <div class="screen-body-item left">
              <div class="app-title">
                <span>Create Post</span>
              </div>
              <!-- DYNAMIC ERROR MESSAGES -->
              <?php
              if (isset($_GET['error'])) {
                // error=forbidden
                if ($_GET['error'] == 'forbidden') {
                  $errorMsg = "Access denied - please submit form correctly";
                }
                // error=emptyfields
                else if ($_GET['error'] == 'emptyfields') {
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
              <!-- 1. TITLE -->
              <div class="screen-body-item">
                <div class="app-form">
                  <div class="app-form-group">
                    <input type="text" class="app-form-control" name="MovieTitle" placeholder="MovieTitle">
                  </div>
                  <!-- 2. IMAGE URL -->
                  <div class="app-form-group">
                    <input type="text" class="app-form-control" name="ImageURL" placeholder="Image URL">
                  </div>
                  <!-- 3. COMMENT SECTION -->
                  <div class="app-form-group">
                    <input type="text" class="app-form-control" name="ReviewText" placeholder="Review">
                  </div>
                  <!-- Rating -->
                  <div class="app-form-group">
                    <div class="rate" name="Rating">
                      <input type="radio" id="star5" name="Rating" value="5" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="Rating" value="4" />
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="Rating" value="3" />
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="Rating" value="2" />
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="Rating" value="1" />
                      <label for="star1" title="text">1 star</label>
                    </div>
                  </div>
                  <!-- 6. SUBMIT BUTTON -->
                  <div class="app-form-group buttons">
                    <button type="submit" name="post-submit" class="app-form-button">POST</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER.PHP -->
<?php 
  require "./templates/footer.php"
?>
  </form>
