  <?php 
    session_start();
    if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
      // MY POST SUBMISSION SCRIPT EXECUTES
      require './connect.inc.php';

      // Store form data to local variables
      $title = $_POST['MovieTitle'];
      $imageUrl = $_POST['ImageURL'];
      $comment = $_POST['ReviewText'];
      $rating = $_POST['Rating'];      

      // Validation: empty fields
      // if(empty($title) || empty($imageUrl) || empty($comment) || empty($rating)){
      //   header("Location: ../createpost.php?error=emptyfields");
      //   exit();
      // }

      // INSERT DATA into POSTS using prepared statements (5 steps) 
      // Templating
      $sql= "INSERT INTO tblPosts(id, uidUser, MovieTitle, ImageURL, ReviewText, Rating) VALUES (NULL, NULL, ?, ?, ?, ?)";
      $statement = $conn->stmt_init();
      if(!$statement->prepare($sql)){
        header("Location: ../createpost.php?error=sqlerror");
        exit();
      }

      // Execution
      $statement->bind_param("sssss", $uid, $title, $imageUrl, $comment, $rating);
      $statement->execute();
      if($statement->error){
        header("Location: ../createpost.php?error=servererror");
        exit();
      } 
      // SUCCESSFUL SUBMISSION:
      header("Location: ../posts.php?post=success");
      exit();

    } else {
      header("Location: ../createpost.php?error=forbidden");
      exit();
    }
  ?>
