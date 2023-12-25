<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
    }
    .custom-container {
      margin-top: 20px;
      padding: 20px;
    }
    .custom-card {
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      overflow: hidden;
      transition: transform 0.3s ease-in-out;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      height: 120px;
    }
    .custom-card:hover {
      transform: scale(1.05);
    }
    .custom-card-body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 60%;
      padding: 10px;
      text-align: center;
    }
    .custom-card-title {
      color: #6a0572; /* Attractive Lavender color */
      font-size: 1.2em;
      margin-bottom: 5px;
    }
    .custom-card-text {
      color: #555;
      margin-bottom: 10px;
      font-size: 0.9em;
    }
    .custom-btn-primary {
      background-color: #9370db; /* Attractive Lavender color */
      border: none;
      padding: 5px 10px;
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      border-radius: 3px;
      font-size: 0.8em;
      transition: background-color 0.3s ease-in-out;
    }
    .custom-btn-primary:hover {
      background-color: #7a5b8c; /* Darker shade for hover effect */
    }
    .quote-container {
      margin-top: 20px;
      text-align: center;
      padding: 40px;
      background: linear-gradient(to right, #6a0572, #ab83a1); /* Gradient color */
      border-radius: 10px;
    }
    .quote-text {
      font-style: italic;
      color: #fff;
      font-size: 1.2em;
    }
  </style>
  <title>User Panel</title>
</head>
<body>

<div class="quote-container" data-aos="fade-up">
  <p class="quote-text" id="quote">Loading...</p>
</div>

<div class="custom-container">
  <div class="row">
    <div class="col-md-6 col-lg-4">
      <div class="custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title">Search</h5>
          <p class="custom-card-text">Quickly search for books.</p>
          <a href='advance_search.php' class="btn custom-btn-primary">Search</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title">Recently Added Books</h5>
          <p class="custom-card-text">Discover the latest additions to our collection.</p>
          <a href='recent_add.php' class="btn custom-btn-primary">Explore New Books</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title">Return Books</h5>
          <p class="custom-card-text">Return your borrowed books to the library hassle-free.</p>
          <a href="my_return.php" class="btn custom-btn-primary">Return Books</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title">View Fines</h5>
          <p class="custom-card-text">Check your fines and overdue book details.</p>
          <a href="my_fine.php" class="btn custom-btn-primary">Check Fines</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title">Access E-books</h5>
          <p class="custom-card-text">Explore a wide range of e-books and digital content.</p>
          <a href="elist.php" class="btn custom-btn-primary">Access E-books</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title">Help & Support</h5>
          <p class="custom-card-text">Get assistance or find answers to common queries.</p>
          <a href="helpsup.php" class="btn custom-btn-primary">Get Help</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
  
   const quotes = [
    "Books are a uniquely portable magic. - Stephen King",
    "A room without books is like a body without a soul. - Marcus Tullius Cicero",
    "The more that you read, the more things you will know. The more that you learn, the more places you'll go. - Dr. Seuss",
    "There is no friend as loyal as a book. - Ernest Hemingway",
    "Reading is to the mind what exercise is to the body. - Joseph Addison",
    "A book is a dream that you hold in your hand. - Neil Gaiman",
    "The only thing you absolutely have to know is the location of the library. - Albert Einstein",
    "A reader lives a thousand lives before he dies. - George R.R. Martin",
    "I find television very educational. Every time someone turns it on, I go in the other room and read a book. - Groucho Marx",
    "Books are the quietest and most constant of friends; they are the most accessible and wisest of counselors, and the most patient of teachers. - Charles W. Eliot",
    "The book you don't read won't help. - Jim Rohn",
    "To learn to read is to light a fire; every syllable that is spelled out is a spark. - Victor Hugo",
    "A well-read woman is a dangerous creature. - Lisa Kleypas",
    "Reading brings us unknown friends. - Honoré de Balzac",
    "When I have a little money, I buy books; and if I have any left, I buy food and clothes. - Desiderius Erasmus",
    "You can never get a cup of tea large enough or a book long enough to suit me. - C.S. Lewis",
    "Reading is a discount ticket to everywhere. - Mary Schmich",
    "Books are a mirror: if an ass peers into them, you can't expect an apostle to look out. - Georg Christoph Lichtenberg",
    "So many books, so little time. - Frank Zappa",
    "A book is a version of the world. If you do not like it, ignore it; or offer your own version in return. - Salman Rushdie"
  ];
  // Function to display a random quote
  function displayRandomQuote() {
    const randomIndex = Math.floor(Math.random() * quotes.length);
    const quoteElement = document.getElementById("quote");
    quoteElement.textContent = quotes[randomIndex];
  }

 
  displayRandomQuote();
</script>
</body>
</html>
