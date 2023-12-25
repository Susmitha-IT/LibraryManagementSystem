<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: index.php");
    exit();
}
?><?php
if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    header("Location: index.php");
    exit; 
}
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>Booklandia Admin Dashboard</title>
	<link rel="icon" href="booklandis.png" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <style>
    .sidebar {
      background-color: #000;
      min-height: 100vh;
      padding: 20px;
      position: fixed;
      top: 0;
      left: -300px;
      width: 200px;
      transition: left 0.3s ease-in-out;
      z-index: 1;
    }

    .sidebar.open {
      left: 0;
    }

    .sidebar-header {
      padding-bottom: 20px;
      background-color: #000;
      color: #fff;
    }

    .sidebar ul.components {
      padding: 0;
      margin-top: 20px;
    }

    .sidebar ul li a {
      padding: 10px 20px;
      display: block;
      color: #fff;
    }

    .sidebar ul li a:hover {
      background-color: #007bff;
      color: #fff;
    }

    .sidebar .collapse {
      padding-left: 20px;
    }

    .sidebar .collapse ul li a {
      padding: 5px 20px;
      color: #ccc;
    }

    .sidebar .collapse ul li a:hover {
      background-color: #007bff;
      color: #fff;
    }

    .sidebar-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 100;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }

    /* Update the colors here */
    .sidebar-header {
      background-color: #000;
    }

    .sidebar ul li a {
      color: #fff;
    }

    .sidebar ul li a:hover {
      background-color: #007bff;
      color: #fff;
    }

    .sidebar .collapse ul li a {
      color: #ccc;
    }

    .sidebar .collapse ul li a:hover {
      background-color: #007bff;
      color: #fff;
    }

    .sidebar-toggle span {
      background-color: #000;
    }

    .sidebar-toggle span:nth-child(2) {
      background-color: #000;
    }

    @media (min-width: 768px) {
      .sidebar-toggle {
        display: none;
      }

      .sidebar {
        position: relative;
        left: 0;
        transition: none;
      }
    }
	#pageTitle {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: linear-gradient(to right, #4CAF50, #2196F3); 
            color: black; /* Change the text color to black */
            font-family: 'Arial', sans-serif; 
            margin-bottom: 10px;
        }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 col-12">
        <div class="sidebar">
          <div class="sidebar-header">
            <h3><a href="?page=dashboard">Dashboard</h3>
          </div>
          <ul class="list-unstyled components">
            <li>
              <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">> Book</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
			  <li><a href="?page=listbk">List</a></li>
                <li><a href="?page=addbk">Add</a></li>
                <li><a href="?page=searchbk">Search</a></li>
                <li><a href="?page=editbk">Edit</a></li>
				<li><a href="?page=delbk">Delete</a></li>
              </ul>
            </li>
			<li>
              <a href="#ebkSubmenu" data-toggle="collapse" aria-expanded="false">> E-Book</a>
              <ul class="collapse list-unstyled" id="ebkSubmenu">
			    <li><a href="?page=listebk">List</a></li>
                <li><a href="?page=addebk">Add</a></li>
              </ul>
            </li>
             <li>
              <a href="#borrowreturnsub" data-toggle="collapse" aria-expanded="false">> Borrow/Return</a>
              <ul class="collapse list-unstyled" id="borrowreturnsub">
			  <li><a href="?page=borrowbk">Borrow</a></li>
                <li><a href="?page=returnbk">Return</a></li>
                <li><a href="?page=duebk">Search</a></li>
				<li><a href="?page=fine">Fine</a></li>
              </ul>
            </li>
            <li>
              <a href="#usermenu" data-toggle="collapse" aria-expanded="false">> User</a>
              <ul class="collapse list-unstyled" id="usermenu">
                <li><a href="?page=list">List</a></li>
                <li><a href="?page=search">Search</a></li>
                <li><a href="?page=delete">Delete</a></li>
              </ul>
            </li>
            <li>
              <a href="?page=backup" >> Back up</a>
              
            </li>
			<br><br><br><br>
			<li>
              <a href="?page=logout" ><i class="fa fa-sign-out fa-1x"></i>&nbsp;&nbsp;Log Out</a>
              
			<?php
            if (isset($_GET['page']) && $_GET['page'] == 'logout') {
            session_destroy();
            header("Location:index.php");
            ob_end_flush();
            exit;
            }
            ?>

            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-10 col-12"> 
	  <div id="pageTitle">
        BookLandia Library Admin Panel
    </div>
        <?php
  if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
      case 'list':
        include('userview.php');
        break;
       case 'search':
        include('usersearch.php');
        break;
       case 'delete':
        include('userdelete.php');
        break;
		case 'addbk':
        include('bookadd.php');
        break;
		case 'searchbk':
        include('bookSearch.php');
        break;
		case 'editbk':
        include('bookedit.php');
        break;
		case 'delbk':
        include('bookdelete.php');
        break;
		case 'listbk':
        include('booklist.php');
        break;
		case 'borrowbk':
        include('borrow.php');
        break;
		case 'returnbk':
        include('return.php');
        break;
		case 'duebk':
        include('overdue.php');
        break;
		case 'fine':
        include('fine.php');
        break;
		case 'backup':
        include('backup.php');
        break;
		case 'addebk':
        include('ebkAdd.php');
        break;
		case 'listebk':
        include('ebklist.php');
        break;	
        case 'dashboard':
        include('dashdata.php');
        break;			
  }}
	else{
	include('dashdata.php');
	}
  
  ?>
    
      </div>
    </div>
  </div>

  <button id="sidebarToggle" class="sidebar-toggle d-md-none">
    <span class="navbar-toggler-icon"></span>
  </button>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.sidebar .collapse').on('show.bs.collapse', function () {
        $(this).closest('li').addClass('active');
      });

      $('.sidebar .collapse').on('hide.bs.collapse', function () {
        $(this).closest('li').removeClass('active');
      });

      $('#sidebarToggle').on('click', function () {
        $('.sidebar').toggleClass('open');
      });
    });
  </script>
</body>
</html>