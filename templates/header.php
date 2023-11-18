<!-- 7. START NEW SESSION -->
<?php
  // Starts a session on ALL pages for website as header.php file will be on ALL pages
  // NOTE: Need to start session, as otherwise, we cannot access any variables within $_SESSION superglobal, and see if we are logged in OR not!
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <!-- Bootstrap 5.0 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <!-- css -->
  <link rel="stylesheet" href="./css/style.css">
  <!-- js -->
	<script src="./js/main.js" defer></script>

</head>
<body>
  <!-- HEADER -->
  <header class="header">
    <a href="./index.php" class="logo">
      <img src="./images/logo-movie__1_-removebg-preview.png" width="140" height="100" alt="Movie Mania">
    </a>
    <!-- 1. NAVBAR -->
    <nav class="menu">
      <ol>
        <li class="menu-item">
          <a href="index.php">Home</a>
        </li>
        <li class="menu-item">
          <a href="movies.php">Movies</a>
        </li>
        <li class="menu-item">
          <a href="upload.php">Upload</a>
        </li>
        <li class="menu-item">
          <a href="post.php">Post</a>
        </li>
        <!-- Conditional Create Post Button -->
      <?php 
        // Check global $_SESSION variable to see if a user is logged in
        // NOTE: Does NOT exist BUT useful to show power of sessions!
        if(isset($_SESSION['userId'])){
        echo '<li class="menu-item">
            <a class="menu-itemk" href="./createpost.php">Create Post</a>
          </li>';
        }
      ?>
        <li class="menu-item">
          <a
            href="signup.php"
            >Signup</a
          >
        </li>
      <!-- H. LOGOUT FUNCTIONALITY -->
      <!-- 1. Logout Button + 6. Wrap Logout/Login Buttons in Conditional Statement -->
      <?php 
        if(isset($_SESSION['userId'])){
          // (i) Checks global $_SESSION variable to see if user is logged in & display Logout Button
          echo '<li class="menu-item">
          <form action="./includes/logout.inc.php" action="POST">
            <a class="menu-item"><button type="submit" class="menu-item-lockIcon" name="logout-submit">Logout</button></a>
          </form>
        </li>';
        } else {
          // (ii) Display Login Button if no Session Variables
          echo '<li class="menu-item"><a href="login.php">Login</a></li>';
        }
      ?>  
      </ol>
    </nav>
    </header>
    <!-- Header: END -->
