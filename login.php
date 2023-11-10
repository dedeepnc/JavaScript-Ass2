<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
    <!-- Login -->
    <form action="includes/login.inc.php" method="post">
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
                <span>LOGIN</span>
              </div>
              <div class="app-contact">CONTACT INFO : +0415 555 555</div>
            </div>
            <!-- 1. USERNAME -->
            <div class="screen-body-item">
              <div class="app-form">
                <div class="app-form-group">
                  <input type="text" class="app-form-control" name="uid" placeholder="Username" required>
                </div>
                <!-- 3. PASSWORD -->
                <div class="app-form-group">
                <input type="password" class="app-form-control" name="pwd" placeholder="Password" required>
                </div>
                <div class="app-form-group buttons">
                <button class="app-form-button" name="login-submit">LOGIN</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    </form>
  </body>
  