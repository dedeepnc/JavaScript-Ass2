document.addEventListener("DOMContentLoaded", function () {
  const search = document.querySelector("#search");
  const searchBtn = document.querySelector("#searchBtn");
  const movies = document.querySelector(".movies");
  const errorMessage = document.querySelector("#error");
  errorMessage.style.display = "none";

  const apikey = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZjc4ZDNmMTFkZDQzODFhZDRkYmQwMjc2MGUzNWEyYSIsInN1YiI6IjY1M2RlYTdmY2M5NjgzMDE0ZWI5NzQ3MSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Zh3uZfltLYQnDEQMwFL6ZH3-fwnWVH7J92lvmgaLJwk'; // Replace with your actual API key

  // Function to fetch and display popular movies
  function loadPopularMovies() {
    const options = {
      method: 'GET',
      headers: {
        accept: 'application/json',
        Authorization: `Bearer ${apikey}`,
      }
    };

    // Use the Movie Database (TMDb) API to fetch popular movies
    fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', options)
      .then(response => response.json())
      .then(response => {
        displayMovies(response.results);
      })
      .catch(err => console.error(err));
  }

  // Function to display movies
  function displayMovies(moviesData) {
    errorMessage.style.display = "none";
    console.log(moviesData);
    if (moviesData.length === 0) {
      errorMessage.style.display = "block";
      errorMessage.innerHTML = "No results found";
    }
    movies.innerHTML = '';

    moviesData.forEach(movie => {
      const movieContainer = document.createElement("div");
      movieContainer.classList.add("movie");

      const title = document.createElement("h2");
      title.innerHTML = movie.title;
      const poster = document.createElement("img");
      console.log(movie);
      if (movie.poster_path != null) {

        poster.src = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
        poster.alt = movie.title + " Poster";
      } else {
        poster.src = `./images/noposter.jpg`;
        poster.alt = movie.title + " Poster";
      }


      movieContainer.appendChild(poster);
      movieContainer.appendChild(title);
      movies.appendChild(movieContainer);
    });
  }

  // Call the function to load popular movies when the page loads
  loadPopularMovies();

  window.addEventListener("load", function () {
    const searchQuery = localStorage.getItem("searchQuery");
    if (searchQuery !== null) {
      search.value = searchQuery;
      getSearch(searchQuery);
    }
  })

  searchBtn.addEventListener("click", function (event) {
    event.preventDefault();

    const query = search.value;
    localStorage.setItem("searchQuery", query);

    if (query.trim() !== "") {
      getSearch(query);
    }
  });

  function getSearch(query) {
    const options = {
      method: 'GET',
      headers: {
        accept: 'application/json',
        Authorization: `Bearer ${apikey}`,
      }
    };

    // Use the Movie Database (TMDb) search API
    fetch(`https://api.themoviedb.org/3/search/movie?query=${query}&include_adult=false&language=en-US&page=1`, options)
      .then(response => response.json())
      .then(response => {
        displayMovies(response.results);
      })
      .catch(err => console.error(err));
  }
});





