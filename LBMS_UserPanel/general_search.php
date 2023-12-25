<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/search.css">
</head>
<body>
    <div class="container">
         <div class="container">
        <h2 class="my-4 text-center">Book Search</h2>
        <form id="searchForm">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="isbn">Search ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN">
                </div>
                <div class="form-group col-md-4">
                    <label for="author">Search Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author">
                </div>
                <div class="form-group col-md-4">
                    <label for="title">Search Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                </div>
            </div>
			<center>
            <button type="submit" class="btn btn-primary">Search</button>
            <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
			</center>
        </form>

        <div id="searchResults" class="my-4 card-container">
       


        </div>
    </div>

       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      $(window).scroll(function() {
            $('.fadeInUp').each(function() {
                var elementTop = $(this).offset().top;
                var windowHeight = $(window).height();
                var scrollTop = $(window).scrollTop();
                if (elementTop - windowHeight < scrollTop) {
                    $(this).addClass('animated');
                }
            });
        });

        $('#searchForm').submit(function(e) {
            e.preventDefault();
            $('#searchResults').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Searching...</div>');
            $.ajax({
                type: 'POST',
                url: 'search_process.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#searchResults').html(response).addClass('fadeInUp card-container'); // Add fadeInUp class for animation
                },
                error: function() {
                    $('#searchResults').html('<div class="text-center text-danger">An error occurred. Please try again.</div>');
                }
            });
        });
         $('#resetBtn').click(function() {
            $('#searchForm')[0].reset();
            $('#searchResults').html('');
        });
    </script>
</body>
</html>
