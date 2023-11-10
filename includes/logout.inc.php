<?php
  session_start();

  // Take all session values & remove them + end the session
  session_unset();
  session_destroy();

  // Redirect user
  header("Location: ../index.php");
?>