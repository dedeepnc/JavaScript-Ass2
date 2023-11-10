<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
    <!-- CONTACT FORM-->
    <form action="includes/signup.inc.php" method="post">
      <!-- F. SIGNUP MESSAGES -->
      <?php
        // 1. VALIDATION: If error/success in $_GET - dsiplay appropriate message
        if(isset($_GET['error'])){

          // (i) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields";

          // (ii) Invalid Email AND Password
          } else if ($_GET['error'] == "invalidmailuid") {
            $errorMsg = "Invalid email and Password";

          // (iii) Invalid Email
          } else if ($_GET['error'] == "invalidmail") {
            $errorMsg = "Invalid email";

          // (iv) Invalid Username
          } else if ($_GET['error'] == "invaliduid") {
            $errorMsg = "Invalid username";

          // (v) Password Confirmation Error
          } else if ($_GET['error'] == "passwordcheck") {
            $errorMsg = "Passwords do not match";

          // (vi) Username MATCH in database on save
          } else if ($_GET['error'] == "usertaken") {
            $errorMsg = "Username already taken";

          // (vii) Internal server error 
          } else if ($_GET['error'] == "sqlerror") {
            $errorMsg = "An internal server error has occurred - please try again later";
          
          // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
          }
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
        
        // 2. SUCCESS MESSAGE: Successful sign up to DB
        } else if (isset($_GET['signup']) == "success") {
          echo '<div class="alert alert-success" role="alert">You have successfully signed up!</div>';    
        }

        // 3. PRE-FILL FORM for ERROR: Need to populate form with any user data passed back into form, to save user from repeating it!
        // NOTE: We will create a "value" attribute in form below & set an if statement to run if either the uid or mail is stored in GET superglobal & echo it back!
      ?>
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
                <span>SIGNUP</span>
              </div>
              <div class="app-contact">CONTACT INFO : +0415 555 555</div>
            </div>
            <!-- 1. USERNAME -->
            <div class="screen-body-item">
              <div class="app-form">
                <div class="app-form-group">
                  <input type="text" class="app-form-control" name="uid" placeholder="Username" value=<?php if(isset($_GET['uid'])){ echo $_GET['uid']; }?> >
                </div>
                <!-- 2. EMAIL -->
                <div class="app-form-group">
                  <input type="email" class="app-form-control" name="mail" placeholder="Email" value=<?php if(isset($_GET['mail'])){ echo $_GET['mail']; }?>>
                </div>
                <!-- 3. PASSWORD -->
                <div class="app-form-group">
                  <input type="password" class="app-form-control" name="pwd" placeholder="Password">
                </div>
                <!-- 4. PASSWORD CONFIRMATION -->
                <div class="app-form-group password">
                  <input type="password" class="app-form-control" name="pwd-repeat" placeholder="Confirm Password">
                </div>
                <div class="app-form-group buttons">
                  <button class="app-form-button" name="signup-submit">SIGN UP</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    </form>