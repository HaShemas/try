<?php
session_start();
require_once("database.php");

      if(isset($_SESSION['hr_id'])){
        $hr_id = $_SESSION['hr_id'];
     

        // query database for employee information based on employee ID
        

        $sql2="SELECT * FROM employee_tbl INNER JOIN leave_tbl ON employee_tbl.employee_id=leave_tbl.employee_id WHERE employee_tbl.employee_id=leave_tbl.employee_id AND employee_tbl.employee_id !='11' AND employee_tbl.status = '1'";
        $query2 = mysqli_query($connection, $sql2);
    // retrieve employee's time schedule
        $row2 = mysqli_fetch_assoc($query2);
        
    } else {
        // employee ID not found in session variable, redirect to login page
        header("Location: login.php");
        exit();
       
    }

    
?>
<?php

// If the user is not logged in, redirect to the login page

// If the user clicked the logout button, destroy the session and redirect to the login page

?>


<!DOCTYPE html>
<html>
<head>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <head>
  <link href="https://fonts.googleapis.com/css?family=Inter:400,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="attend_style.css">
</head>
  <div class="container">
    <nav></nav>
    <main style="width: 140%; height: auto;">
    
  
  <br>
  EMPLOYEE'S LEAVE HISTORY
  <br>
  <br>
  <br>
  <form method="POST" action="" class="form">
    <br>
    <br>
    <br>
  </form>
  <form action="" method="POST">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">
    <input type="submit" value="Search">
    
  </form>
  <br>

  <?php if (isset($_POST['search'])) { echo "<div style='margin-bottom: 20px;'></div>"; } ?>

<?php
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];

    // Perform the search
    $sql2 = "SELECT * FROM employee_tbl WHERE employee_tbl.employee_id=$search AND employee_tbl.employee_id !='11' AND employee_tbl.status = '1'";
    $result = mysqli_query($connection, $sql2);
    $row3 = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        // Display the search results in a table
        ?>
        <table class="table table-bordered" border="1" style="width: 100%; table-layout: auto;">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th> ACTION</th>  
                    
                </tr>
            </thead>
            <tbody>
            <?php mysqli_data_seek($result, 0); // reset query pointer ?>
            <?php while ($row2 = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row3["employee_id"];?></td>
                    <td><?php echo $row3["fname"];?></td>
                    <td><?php echo $row3["mname"];?></td>
                    <td><?php echo $row3["lname"];?></td>
                    <td><?php echo $row3["phone_number"];?></td>
                    <td><?php echo $row3["email"];?></td>

                    <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view<?php echo $row2['employee_id']; ?>">
                      <span class="glyphicon glyphicon-eye-open"></span> View
                    </button>
                        <?php include('e-list-view.php'); ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        include('e-list-view.php'); 
    }
    else {
        echo "No results found.";
    }
}

else
{
  // Display the table for all employees
  $sql3 = "SELECT * FROM employee_tbl WHERE employee_tbl.employee_id !='11' AND employee_tbl.status = '1'";
  $query3 = mysqli_query($connection, $sql3);

?>
<div style="display: flex; justify-content: space-between; margin-left: 50px;">
    <div style="text-align: left;">LIST OF EMPLOYEES:</div>
    <br>
    <br>
  </div>
  <table class="table table-bordered" border="1" style="width: 100%; table-layout: auto;">
    <thead>
      <tr>
        <th>Employee ID</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <?php mysqli_data_seek($query3, 0); // reset query pointer ?>
      <?php while ($row2 = mysqli_fetch_assoc($query3)) { ?>
        <tr>
          <td><?php echo $row2["employee_id"]; ?></td>
          <td><?php echo $row2["fname"]; ?></td>
          <td><?php echo $row2["mname"]; ?></td>
          <td><?php echo $row2["lname"]; ?></td>
          <td><?php echo $row2["phone_number"]; ?></td>
          <td><?php echo $row2["email"]; ?></td>

          <td>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view<?php echo $row2['employee_id']; ?>">
          <span class="glyphicon glyphicon-eye-open"></span> View
        </button>
         <?php include('e-list-view.php'); ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php include('e-list-view.php'); 
  }

  
?>
  
</main>

    <div id="sidebar" style="height: auto;">
      <img src="https://dm0qx8t0i9gc9.cloudfront.net/thumbnails/image/rDtN98Qoishumwih/graphicstock-sleepy-tired-business-woman-holding-cup-of-coffee-and-yawning-while-working-in-office-exhausted-business-woman-yawning-and-drinking-coffee-at-work-vector-flat-design-illustration-square-layout_SQeBTBdILb_thumb.jpg" alt="Image" height="80" width="80" style="border-radius: 50%;">
      <br></br>HR ID: <?php echo $hr_id; ?><br></br>
      <a href="dashboard-admin.php" class="button">HOME</a>
      <a href="leave-admin.php" class="button">BACK</a>
          </div>
    <div id="content1"></div>
    <div id="content2"><br></br><br></br></div>
    <div id="content3"></div>

    <footer></footer>
    
  </div>
</body>
</body>
</html>