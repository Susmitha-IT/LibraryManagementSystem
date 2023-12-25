<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="icon" href="booklandis.png" type="image/x-icon">
  <style>
    form {
      padding: 30px;
    }
    
    .search-submit {
      background: none;
      border: none;
      font-size: 34px;
      color: #000;
      cursor: pointer;
    }
    
    .delete-button {
      background-color: red;
      color: white;
      border-color: red;
    }
    
    .delete-button:hover {
      background-color: darkred;
      border-color: darkred;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="" method="post" class="mb-4">
      <div class="form-row">
        <div class="col-md-3 form-group">
          <input type="text" placeholder="Username" id="username" class="form-control" name="username">
        </div>
        <div class="col-md-3 form-group">
          <input type="email" placeholder="Email" id="email" class="form-control" name="email">
        </div>
        <div class="col-md-3 form-group">
          <select id="status" class="form-control" name="status" >
            <option value="">Status</option>
            <option value="approved">Approve</option>
            <option value="pending" >Pending</option>
            <option value="rejected">Reject</option>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <button type="submit" name='searchdel' class="search-submit"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>

    <?php
    if (isset($_POST['searchdel'])) {
      $conn = mysqli_connect("localhost", "root", "root", "userdb");
      $username = isset($_POST['username']) ? $_POST['username'] : '';
      $email = isset($_POST['email']) ? $_POST['email'] : '';
      $status = isset($_POST['status']) ? $_POST['status'] : '';
      
      $query = "SELECT * FROM users WHERE 1=1";

      if (!empty($username)) {
        $query .= " AND username LIKE '%$username%'";
      }

      if (!empty($email)) {
        $query .= " AND email LIKE '%$email%'";
      }

      if (!empty($status)) {
        $query .= " AND status = '$status'";
      }

      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['username']."</td>";
                  echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['created_at']."</td>";
                  echo "<td>".$row['status']."</td>";
                  echo "<td>";
                  echo "<button type='button' class='btn btn-danger btn-sm delete-button' data-toggle='modal' data-target='#confirmationDialog' data-id='".$row['id']."'><i class='fas fa-trash-alt'></i></button>";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
          <?php
        } else {
          echo "No records were found.";
        }
        
        mysqli_close($conn);
      }
      ?>

      <div class="modal fade" id="confirmationDialog" tabindex="-1" role="dialog" aria-labelledby="confirmationDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationDialogLabel">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to proceed?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" id="confirmButton">OK</button>
            </div>
          </div>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script>
        $(document).ready(function() {
          var deleteId;

          $('.delete-button').click(function() {
            deleteId = $(this).data('id');
            $('#confirmationDialog').modal('show');
          });

          $('#confirmButton').click(function(e) {
             e.preventDefault();
             $.ajax({
            type: 'GET',
            url: 'admin_process.php',
      data: {
        confirmButton: true,
        delid: deleteId,
       
      },
      success: function(response) {
        // Handle the response from the PHP code
        $('#confirmationDialog').modal('hide');
        location.reload();
        // You can perform additional actions after the form submission here
      },
      error: function(xhr, status, error) {
        console.error(error); // Log any errors to the console
      }
    });
			
          });
        });
      </script>
    </body>
    </html>
