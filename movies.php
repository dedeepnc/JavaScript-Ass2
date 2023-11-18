  <!-- HEADER.PHP -->
  <?php
  require "templates/header.php"
  ?>
  <!-- END OF HEADER.PHP -->
<!-- Search -->
<div id="cover">
      <form method="get" action="">
        <div class="tb">
          <div class="td"><input type="text" id="search" placeholder="Search" required></div>
          <div class="td" id="s-cover">
            <button type="submit" id="searchBtn">
              <div id="s-circle"></div>
            </button>
          </div>
        </div>
      </form>
      <p id="error">Error message</p>
    </div>
    <div id="movies" class="movies"></div>

    <?php 
  require "templates/footer.php"
?>