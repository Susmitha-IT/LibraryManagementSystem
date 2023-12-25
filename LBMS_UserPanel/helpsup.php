<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyW8AVEI0tIF+ITqPz8l+1RfEXmLj5Vew"
        crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
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
    </style>
</head>

<body>
  
        

        <!-- Live Chat Widget -->
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
                return 'Sure! To borrow a book, log in to your account, search for the desired book, and click the \'Borrow\' button.';
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
</body>

</html>
