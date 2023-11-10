<?php 
  // Check form has been submitted using button
  if(isset($_POST['signup-submit'])){
    // Connect to DB
    require './connect.inc.php';

    // Store our POST form data under local variables
    $username = $conn->real_escape_string($_POST['uid']);
    $email = $conn->real_escape_string($_POST['mail']);
    $password = $conn->real_escape_string($_POST['pwd']);
    $passwordRepeat = $conn->real_escape_string($_POST['pwd-repeat']);
    $pwdReg = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

    // VALIDATION:
    // Checking for empty fields
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
      // ERROR: Empty field = redirect
      header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
      exit();
    } 

    // BOTH the username AND email are both incorrect at the same time
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidmailuid");
      exit();
    }

    // Check username is an alphanum
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invaliduid&mail=" . $email);
      exit();
    }

    // Check the email is validly formed
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidmail&uid=" . $username);
      exit();
    }

    // Strict password character check (min 8 chars, 1 capital, 1 symbol, 1 number) 
    else if(!preg_match($pwdReg, $password)) {
      header("Location: ../signup.php?error=invalidpwd&uid=" . $username . "&mail=" . $email);
      exit();
    }

    // Checks if the password does NOT match the repeat password
    else if($password !== $passwordRepeat) {
      header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
      exit();
    }

    // VALIDATION COMPLETE = DATA IS SAFE & VALID
    else {
      // Check there is no duplicate user already (SQL)
      // Prepared statements - 5 to 6 (READ) steps
      // 1. Placeholder SQL
      $sql = "SELECT idUsers FROM tblUsers WHERE uidUsers=?";

      // 2. Init prepared statement
      $statement = $conn->stmt_init();

      // 3. Preparing SQL to DB & testing it
      if(!$statement->prepare($sql)){
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }

      // 4. Binding the data to the statement
      $statement->bind_param("s", $username);

      // 5. Execution of the prepared statement
      $statement->execute();
      if($statement->error){
        header("Location: ../signup.php?error=servererror");
        exit();
      }

      // 6. [SELECT] Return our db data result & store
      $statement->store_result();

      // Check the result to see if there was a match = DUPLICATE
      $resultCheck = $statement->num_rows();
      if($resultCheck > 0){
        header("Location: ../signup.php?error=usertaken&mail" . $email);
        exit();

      // SUCCESS: No duplicate user & they can save to the DB (+encrypt pwd)
      } else {
        // ROUND 2 OF PREPARED STATMENTS: Save the user to DB [WRITE]
        // 1. Placeholder SQL
        $sql = "INSERT INTO tblUsers(uidUsers, emailUsers, pwd) VALUES (?,?,?);";

        // 2. Init prepared statement
        $statement = $conn->stmt_init();

        // 3. Preparing SQL to DB & testing it
        if(!$statement->prepare($sql)){
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }

        // 4a. Encrypt the password
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        // 4b. Binding the data to the statement
        $statement->bind_param("sss", $username, $email, $hashedPwd);

        // 5. Execution of the prepared statement
        $statement->execute();
        if($statement->error){
          header("Location: ../signup.php?error=servererror");
          exit();
        }
        // ON SUCCESS: Navigate back to signup
        header("Location: ../signup.php?signup=success");
        exit();
      }
    }    
    // Close the statement/script
    $statement->close();
    $conn->close();

  } else {
    // User has NOT submitted form correctly
    header("Location: ../signup.php?error=forbidden");
    exit();
  }
?>