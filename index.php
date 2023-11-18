<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
 <!-- HEADER.PHP -->
  <body>
  <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css">
  <!-- Showcase Movies -->
<section class="movie-section">
  <h2 class="line-title">Popular Movies</h2>
  <div class="owl-carousel custom-carousel owl-theme">
    <div class="item" style="background-image: url(https://www.themoviedb.org/t/p/w600_and_h900_bestv2/NNxYkU70HPurnNCSiCjYAmacwm.jpg);" onclick="showVideo('https://youtu.be/HurjfO_TDlQmission-impossible-dead-reckoning-part-one#play=HurjfO_TDlQ')">
      <div class="item-desc">
        <h3>Mission: Impossible - Dead Reckoning Part One</h3>
        <p>Ethan Hunt and his IMF team embark on their most dangerous mission yet: To track down a terrifying new weapon that threatens all of humanity before it falls into the wrong hands.</p>
        <button class="play-button">Play Trailer</button>
      </div>
    </div>
    <div class="item" style="background-image: url(https://www.themoviedb.org/t/p/w600_and_h900_bestv2/j9mH1pr3IahtraTWxVEMANmPSGR.jpg);" onclick="showVideo('https://youtu.be/X4d_v-HyR4o')">
      <div class="item-desc">
        <h3>Five Nights at Freddy's</h3>
        <p>Recently fired and desperate for work, a troubled young man named Mike agrees to take a position as a night security guard at an abandoned theme restaurant: Freddy Fazbear's Pizzeria. But he soon discovers that nothing at Freddy's is what it seems.</p>
        <button class="play-button">Play Trailer</button>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div id="videoModal" class="modal">
  <div class="modal__overlay" onclick="closeModal()"></div>
  <div class="modal__wrapper">
    <iframe id="videoIframe" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>

<!-- JavaScript -->
<script>
  function showVideo(videoUrl) {
    const videoId = extractVideoId(videoUrl);
    const iframe = document.getElementById('videoIframe');
    iframe.src = `https://www.youtube.com/embed/${videoId}`;
    
    const modal = document.getElementById('videoModal');
    modal.style.display = 'block';
  }

  function closeModal() {
    const modal = document.getElementById('videoModal');
    modal.style.display = 'none';
    
    // Pause the video when closing the modal
    const iframe = document.getElementById('videoIframe');
    iframe.src = '';
  }

  function extractVideoId(videoUrl) {
    // Extract video ID from the given URL
    const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
    const match = videoUrl.match(regex);
    return match ? match[1] : null;
  }

</script>
<!-- 
  Explanation of the extractVideoId function:
  
  (?: ... ): Non-capturing group. Groups multiple patterns together without capturing the matched result.
  https?:\/\/: Matches "http://" or "https://".
  www\.?: Matches "www." (optional).
  youtube\.com\/: Matches "youtube.com/".
  (?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=): Alternation between three options:
    [^\/\n\s]+\/\S+\/: Matches the video ID in the format "/videoID/".
    (?:v|e(?:mbed)?)\/: Matches the video ID in the format "/v/" or "/e/" or "/embed/".
    \S*?[?&]v=: Matches the video ID in the format "?v=" or "&v=".
  youtu\.be\/: Matches "youtu.be/" for short URLs.
  ([a-zA-Z0-9_-]{11}): Captures the 11-character video ID (alphanumeric with underscores and dashes).
-->

    <!-- Slider Movies -->
    <h1 class="main-header">Movies You Might Like</h1>
    <div class="movie-slider">

   
    <div class="movie-list">
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/iR1bVfURbN7r1C46WHFbwCkVve.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">About Time</h1>
                <a href="https://www.themoviedb.org/movie/122906-about-time" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/7BsvSuDQuoqhWmU2fL7W2GOcZHU.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Green Book</h1>
                <a href="https://www.themoviedb.org/movie/490132-green-book" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/yn5ihODtZ7ofn8pDYfxCmxh8AXI.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Little Women</h1>
                <a href="https://www.themoviedb.org/movie/331482-little-women" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/mbm8k3GFhXS0ROd9AD1gqYbIFbM.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">The Irishman</h1>
                <a href="https://www.themoviedb.org/movie/398978-the-irishman" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/arw2vcBveWOVZr6pxd9XTd1TdQa.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Forrest Gump</h1>
                  <a href="https://www.themoviedb.org/movie/13-forrest-gump" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>       
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">John Wick: Chapter 4</h1>
                <a href="https://www.themoviedb.org/movie/603692-john-wick-chapter-4" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- 2 -->
<h1 class="main-header">Upcoming Movies</h1>
    <div class="movie-slider">
    <div class="movie-list">
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/bkpPTZUdq31UGDovmszsg2CchiI.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Trolls Band Together</h1>
                <h2 class="movie-title">Nov 30, 2023</h2>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/mBaXZ95R2OxueZhvQbcEWy2DqyO.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">The Hunger Games: The Ballad of Songbirds & Snakes</h1>
                <h2 class="movie-title">Nov 16, 2023</h2>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/jE5o7y9K6pZtWNNMEw3IdpHuncR.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Napoleon</h1>
                <h2 class="movie-title">Nov 23, 2023</h2>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/8QtDhh8mnGUEyrJsaeb3kYgDRaA.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Wish</h1>
                <h2 class="movie-title">Nov 22, 2023</h2>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/opUXVi8FtgIWi8cy8mo90vMPimQ.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Saltburn</h1>
                <h2 class="movie-title">Nov 17, 2023</h2>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/dbABBH3DvFLkBUKwPUG0BlTYdmh.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Wonka</h1>
                <h2 class="movie-title">Dec 06, 2023</h2>
            </div>
        </div>
    </div>
</div>
<!-- 3 -->
<h1 class="main-header">Now Playing Movies</h1>
    <div class="movie-slider">
    <div class="movie-list">
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/j9mH1pr3IahtraTWxVEMANmPSGR.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Five Nights at Freddy's</h1>
                <a href="https://www.themoviedb.org/movie/507089-five-nights-at-freddy-s" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/aQPeznSu7XDTrrdCtT5eLiu52Yu.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Saw X</h1>
                <a href="https://www.themoviedb.org/movie/951491-saw-x" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/iwsMu0ehRPbtaSxqiaUDQB9qMWT.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">Expend4bles</h1>
                <a href="https://www.themoviedb.org/movie/299054-expend4bles" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/qVKirUdmoex8SdfUk8WDDWwrcCh.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">The Exorcist: Believer</h1>
                <a href="https://www.themoviedb.org/movie/807172-the-exorcist-believer" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/tUtgLOESpCx7ue4BaeCTqp3vn1b.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">The Marvels</h1>
                  <a href="https://www.themoviedb.org/movie/609681-the-marvels" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
        <div class="movie-card">
            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/a5EreVlyB9fXzZ2Rf9ugOLrW5YI.jpg" alt="movie poster" class="movie-poster">
            <div class="movie-info">
                <h1 class="movie-title">TAYLOR SWIFT | THE ERAS TOUR</h1>
                <a href="https://www.themoviedb.org/movie/1160164-taylor-swift-the-eras-tour" target="_blank" rel="noopener noreferrer">
                <button class="btn-watch">Watch Now</button>
                </a>
            </div>
        </div>
    </div>
</div>
</body>

</html>
<?php 
  require "templates/footer.php"
?>