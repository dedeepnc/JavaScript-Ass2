<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
<!-- Post -->
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
              <div class="app-title">
                <span>Reviews</span>
              </div>
          <!--  -->
          <div class="screen-body-item">
                <div class="app-form">
                  <div class="app-form-group">
                  <img src="ImageURL" class="card-img-top post-image" alt="">
                  <h3>MovieTitle</h3> 
                  <p>Review</p>
                  <div class="admin-btn">
                  <a href="editpost.php" class="btn btn-secondary mt-2">Edit</a>
                  <a href="includes/deletepost.inc.php" class="btn btn-danger mt-2">Delete</a>
                  </div>
                  </div>
                  </div>
                  </div>
