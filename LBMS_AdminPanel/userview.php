<?php
    $conn=mysqli_connect("localhost", "root", "root", "userdb");
    $query = "SELECT `username`, `email`,`created_at`,`status`,`id` FROM `users` ";
    $result = mysqli_query($conn, $query);
  ?>
  <head>
    <link rel="icon" href="booklandis.png" type="image/x-icon">
</head>
  <br><br>
   <div class="table-responsive">
      <table class="table table-bordered">
  
    <thead>
      <tr>
	    <th>S.no</th>
        <th>Name</th>
        <th>Email</th>
        <th>TimeStamp</th>
		 <th>Status</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
		$i=1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
		  echo "<td>".$i."</td>";
		   echo "<form action='admin_process.php' method='post'>";
		  echo "<td>" . $row['username'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['created_at'] . "</td>";
		  echo "<td>" . $row['status'] . "</td>";
		    echo "<input type='hidden' name='id' value='".$row['id']."'>";
		   echo "<td>";
          echo "<button type='submit' name='approve' class='btn btn-success btn-sm'>Approve</button>&nbsp;&nbsp;&nbsp;";
          echo "<button type='submit' name='reject' class='btn btn-danger btn-sm'>Reject</button>";
          echo "</td></form>";
          echo "</tr>";
		  $i++;
        }
      ?>
    </tbody>
  </table>
  </div>
</div>