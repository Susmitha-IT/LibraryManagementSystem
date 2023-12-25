<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit();
}
?>
<?php
if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    header("Location:login.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booklandia Library</title>
	<link rel="icon" href="booklandia.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyW8AVEI0tIF+ITqPz8l+1RfEXmLj5Vew"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
 

<style>
 body {
            background-color: #f8f9fa;
        }

        .containerz {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
        }

        .chat-messages {
            margin-top: 20px;
        }

        .user-message {
            color: #007bff;
        }

        .support-message {
            color: #28a745;
        }

        .chat-buttons {
            margin-top: 10px;
        }
  .fixed-footer {
    width: 100%;
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
  }

  .content-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .content {
    flex: 1;
    padding-bottom: 60px; /* Adjust as per your footer's height */
    /* Add any additional styles for the content here */
  }
   .fixed-header{
        width: 100%;
               
        top: 0;
    }
	h4 {
            font-size: 1.5em;
			
            margin: 30px 70px;
            color: #3c096c; /* Use a color that matches your design */
        }
		.custom-container {
      margin-top: 50px;
    }
    .custom-card {
      margin-bottom: 20px;
    }
</style>
</head>
<body>
  <header>
  <div class="fixed-header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><h3>Booklandia Library</h3></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
		<li class="nav-item">
            <a class="nav-link" href="?page=home"><i class="fa fa-home fa-1x"></i>&nbsp;&nbsp;Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSearch" role="button"
              data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
              Search
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownSearch">
              <a class="dropdown-item" href="?page=gnlsearch">General Search</a>
              <a class="dropdown-item" href="?page=advsearch">Advanced Search</a>
			   <a class="dropdown-item" href="?page=recentadd">Recently Added</a>
              <!-- Add more search options here -->
            </div>
          </li>
		  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownebook" role="button"
              data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
              E-Book
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownebook">
              <a class="dropdown-item" href="?page=esearch">Search</a>
			   <a class="dropdown-item" href="?page=elist">List</a>
              <a class="dropdown-item" href="?page=feaebk">Featured Books</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              My Borrowings
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
              <a class="dropdown-item" href="?page=myborrow">History</a>
              <a class="dropdown-item" href="?page=myreturn">Return Dates</a>
			  <a class="dropdown-item" href="?page=myfine">Fine Information</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=logout">Log Out&nbsp;&nbsp;<i class="fa fa-sign-out fa-1x"></i></a>
			<?php
            if (isset($_GET['page']) && $_GET['page'] == 'logout') {
            session_destroy();
            header("Location:adminlogin.php");
            ob_end_flush();
            exit;
            }
            ?>
          </li>
        </ul>
      </div>
    </nav>
	</div>
	
  </header>
   <div class="chat-widget" onclick="openChat()">
            Chat with Support
        </div>

        <!-- Live Chat Modal -->
        <div class="modal" id="chatModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                  
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div id="chatMessages" class="chat-messages"></div>
                        <div class="chat-buttons">
                            <button class="btn btn-primary" onclick="sendPredefinedQuestion('How to borrow a book?')">How to borrow a book?</button>
                            <button class="btn btn-primary" onclick="sendPredefinedQuestion('What is the due date for returning books?')">Due date for returning books?</button>
                            <button class="btn btn-primary" onclick="sendPredefinedQuestion('How can I contact support?')">Contact support</button>
							 <button class="btn btn-primary" onclick="sendPredefinedQuestion('How to renew a borrowed book?')">How to renew a borrowed book?</button>
                            <button class="btn btn-primary" onclick="sendPredefinedQuestion('Are there any late fees for overdue books?')">Late fees for overdue books?</button>
                            <button class="btn btn-primary" onclick="sendPredefinedQuestion('How to search for books in the catalog?')">How to search for books?</button>
                            <button class="btn btn-primary" onclick="sendPredefinedQuestion('What are the library hours?')">Library hours?</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyW8AVEI0tIF+ITqPz8l+1RfEXmLj5Vew"
        crossorigin="anonymous"></script>

    <script>
        function openChat() {
            $('#chatModal').modal('show');
        }

        function sendPredefinedQuestion(question) {
            $('#chatMessages').append('<p class="user-message">You: ' + question + '</p>');
            // Simulate a response based on the predefined question
            var answer = 'Support: ' + getResponse(question);
            $('#chatMessages').append('<p class="support-message">' + answer + '</p>');
        }

        function getResponse(userInput) {
            // Implement your chatbot logic here to generate responses based on predefined questions
            // For simplicity, a basic example is provided:
			 if (userInput.toLowerCase().includes('borrow')) {
                return 'Sure! To borrow a book, log in to your account, search for the desired book and check for the available quantity, and borrow directly. Save your time!';
            } else if (userInput.toLowerCase().includes('due date')) {
                return 'The due date for returning books is 10 days from the date of borrowing.';
            } else if (userInput.toLowerCase().includes('contact')) {
                return 'You can contact our support team by emailing support@booklandia.com or by calling (123) 456-7890.';
            } else if (userInput.toLowerCase().includes('renew')) {
                return 'You can renew a borrowed book by logging in to your account, navigating to the \'My Account\' section, and selecting the \'Renew\' option.';
            } else if (userInput.toLowerCase().includes('late fees')) {
                return 'Yes, there is a late fee of Rs. 5 per day for overdue books. Please make sure to return your books on time to avoid late fees.';
            } else if (userInput.toLowerCase().includes('search for books')) {
                return 'To search for books, use the search bar on the library website. You can enter keywords, titles, or authors to find the books you are looking for.';
            } else if (userInput.toLowerCase().includes('library hours')) {
                return 'The library is open from Monday to Friday, 9:00 AM to 6:00 PM, and on Saturdays from 10:00 AM to 4:00 PM. We are closed on Sundays.';
            } else {
                return 'I\'m sorry, I didn\'t understand. Please ask another question.';
            }
        }
           
        
    </script>
  <div class="content-container">
    <div class="content"><br><h4><i>
	<?php echo "Welcome, ".$username."! Explore our digital library and find your next favorite book!";?></i></h4>
	
      <?php
  if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
      case 'gnlsearch':
        include('general_search.php');
        break;
	  case 'advsearch':
        include('advance_search.php');
        break;
	  case 'recentadd':
        include('recent_add.php');
        break;
	  case 'esearch':
        include('esearch.php');
        break;
	  case 'elist':
        include('elist.php');
        break;
	  case 'feaebk':
        include('feaebk.php');
        break;
	   case 'myborrow':
        include('my_borrow.php');
        break;
	  case 'myreturn':
        include('my_return.php');
        break;
	 case 'myfine':
        include('my_fine.php');
        break;
     case 'helpsupport':
        include('helpsup.php');
        break;
	 case 'home':
        include('user_dashdata.php');
        break;
    }
  }
  else{
	include('user_dashdata.php');
	}
  ?>
    </div>
  </div>
  

  <div class="fixed-footer">
    <p><br>&copy; 2023 Library Management System. All rights reserved.</p>
  </div>

  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function () {
    // Initialize dropdowns in the dashboard tab
    $('.dropdown-toggle').dropdown();
  });
</script>

</body>

</html>
