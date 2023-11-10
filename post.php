<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
<!-- Post -->
<main class="container p-4 bg-light mt-3">
    <!-- Basic Bootstrap 5 Card -->
    <div class="card border-0 mt-3" id="">
      <img src="imageurl" class="card-img-top post-image" alt="">
      <div class="card-body">
        <h5 class="card-title">MovieTitle</h5>
        <p class="card-text">Review</p>
        <a href="websiteurl" class="btn btn-primary w-100">Image URL</a>
        <!-- Admin Buttons: User Logged In -->
        <div class="admin-btn">
          <a href="editpost.php" class="btn btn-secondary mt-2">Edit</a>
          <a href="includes/deletepost.inc.php" class="btn btn-danger mt-2">Delete</a>
        </div>
      </div>
    </div>
  </main>