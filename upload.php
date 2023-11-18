<!-- HEADER.PHP -->
<?php 
  require "./templates/header.php"
?>
<?php 
  // B. Declare general variables initial states 
  $directory = "uploads";
  $uploadOk = 1;
  $uploadMessage = "";
  $uploadMessageError = "";

  // F. Set PHP upload errors using superglobal error array within $_FILES (http://php.net/manual/en/features.file-upload.errors.php)
  // F.(1) We set custom message extensions depending on the number passed in by PHP when an upload error occurs
  $phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
  ); 

  // C. Save upload data to variables (using $_FILES superglobal)
  if(isset($_POST['submit'])){
    // (1) Name of the uploaded file
    $fileName = $_FILES['fileToUpload']['name'];
    // (2) File name of the temporary copy of the file stored on the server
    $fileTempName = $_FILES['fileToUpload']['tmp_name'];
    // (3) Name of file type extension (converted to lower case for better handling) & BONUS - cleaner search method
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedFiles = array('jpg', 'jpeg', 'png', 'gif');
    // (4) Size of the file uploaded & our cap on file sizes
    $fileSize = $_FILES['fileToUpload']['size'];
    $maxSize = 1024 * 1024 * 2;     // 2MB
    // (5) Stores our URL path to the uploaded image on the server
    $fileDownloadUrl = $directory . DIRECTORY_SEPARATOR . $fileName;

    // F.(2) Set additional error handler to pick up the PHP error number & pass back the custom message corresponding to the number
    // NOTE: $_FILES['fileToUpload']['error'];  this stores the error code if a error occurred inside the variable $the_error
    $the_error = $_FILES['fileToUpload']['error'];
    if($_FILES['fileToUpload']['error']){
      $uploadMessageError = $phpFileUploadErrors[$the_error];
      $uploadOk = 0;
    }
  
    // D. Set custom error handlers
    // (1) File Already Exists
    // NOTE: We also set if statement to check if message extension is empty ($uploadMessageError == "") to check there are no previous errors & stop it overriding $uploadMessageError if we already have a error
    if($uploadMessageError == "" && file_exists($fileDownloadUrl)){
      $uploadMessageError = "The file already exists.";
      $uploadOk = 0;
    }

    // (2) Incorrect File Extension
    if($uploadMessageError == "" && $fileExt != "jpg" && $fileExt != "png" && $fileExt != "jpeg" && $fileExt != "gif" ){
      $uploadMessageError = "File type is not allowed, please choose a jpg, png, jpeg or gif file";
      $uploadOk = 0;
    }

    // (2BONUS) File Extension CLEANER
    // if(!in_array($fileExt, $allowedFiles)){
    //   $uploadMessageError = "File type is not allowed, please choose a jpg, png, jpeg or gif file";
    //   $uploadOk = 0;
    // }

    // (3) Max File Size
    if($uploadMessageError == "" && $fileSize > $maxSize ){
      $uploadMessageError = "File is too large";
      $uploadOk = 0;
    }

    // E. Set our main error capture & successful upload case 
    // (1) Check for error existing by checking if uploadOk is set to 0 by an error
    if($uploadOk == 0) {
      // (a) ERROR STATE
      $uploadMessage = "<p>Sorry, your file was not uploaded.</p>" . "<strong>Error: </strong>" . $uploadMessageError;
    } else {
      // (b) SUCCESS STATE: If all ok (remains value of 1) - try to upload file to permanent location
      if(move_uploaded_file($fileTempName, $directory . "/" . $fileName)){
        $uploadMessage = "<p>File Uploaded Successfully. " . 'Preview it: <a href="' . $fileDownloadUrl . '" target="_blank">' . $fileDownloadUrl . '</a></p>';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Image|Push</title>
  <style>
    body{
      background-color: #edece7;
    }
    h2 > span {
      font-weight: 800;
    }

    svg {
      color: orangered;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="text-center mb-4">
      <h2 class="display-4 mb-2">
        Movie<span>Pictures 🎞</span>
      </h2>
      <p class="lead">Select image to upload:</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-8">
        <!-- A. File Upload Form: START -->
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <div class="input-group mb-3">     
            <!-- File Input -->
            <input type="file" class="form-control" id="inputGroupFile" name="fileToUpload">
            <!-- Submit Button -->
            <input type="submit" value="Upload" name="submit" class="btn btn-primary input-group-text"></input>
          </div>

        </form>
        <!-- File Upload Form: START -->

        <!-- Alert Message -->
        <?php 
          // F. Create Feedback to user in event of nothing, error or success
          if($uploadMessage == ""){
            echo null;
          } else if($uploadOk == 0){
            echo '<div class="alert alert-danger" role="alert">' . $uploadMessage . '</div>';
          } else {
            echo '<div class="alert alert-success" role="alert">' . $uploadMessage . '</div>';
          }
        ?>
      </div>
    </div>
  </div>  
</body>
<?php 
  require "./templates/footer.php"
  ?>
</html>
<!-- FOOTER.PHP -->
