<?php 
  // Check the form is submitted correctly
  if(isset($_POST['login-submit'])){
    // Connect to the db
    require './connect.inc.php';

    // Store the form variables in local constants/variables
    $uid = $_POST['uid'];
    $password = $_POST['pwd'];
    
    // Validation: Check for empty fields
    if(empty($uid) || empty($password)){
      header("Location: ../index.php?loginerror=emptyfields");
      exit();
    }
    // BONUS: (referring to signup.inc.php) check for a matching email using prepared statements
    // A. Templating
    $sql = "SELECT * FROM tblUsers WHERE uidUsers=? OR emailUsers=?";
    $statement = $conn->stmt_init();
    if(!$statement->prepare($sql)){
      header("Location: ../index.php?loginerror=sqlerror");
      exit();
    }

    // B. Execution
    $statement->bind_param("ss", $uid, $uid);
    $statement->execute();
    if($statement->error){
      header("Location: ../index.php?loginerror=servererror");
      exit();
    }

    // C. Login Check - Check result for matching user
    $result = $statement->get_result();
    if($row = $result->fetch_assoc()){
      // RESULT1 = 1 row -> the user DOES exist
      $pwdCheck = password_verify($password, $row['pwd']);
      // INCORRECT PASSWORD: Failed auth
      if(!$pwdCheck){
        header("Location: ../index.php?loginerror=wrongpwd");
        exit();

      // CORRECT PASSWORD: Success auth
      } else {
        session_start();
        $_SESSION['userId'] = $row['idUsers'];
        $_SESSION['userUid'] = $row['uidUsers'];
        // User logged in = redirect on success
        header("Location: ../index.php?login=success");
        exit();
      }

    } else {
      // RESULT2 = nothing -> the user does NOT exist 
      header("Location: ../index.php?loginerror=nouser");
      exit();
    }
  } else {
    // User has NOT submitted form correctly
    header("Location: ../index.php?loginerror=forbidden");
    exit();
  }
  
?>