<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <style type="text/css">

     body{ font: 14px sans-serif; text-align: center; }
     h1{
          color: rgb(17, 182, 174);
          font-weight: 300;
          font-size:25px;
          text-align: center;
          padding: 20px;
        }
   
header{
    font-size:30px;
    font-weight: 600;
    width: 30%;
    margin: 50px auto 0px;
    color: skyblue;
    background: transparent ;
    text-align: center;
    border: 1px solid transparent;
    border-bottom: none;
    border-radius: 10px 10px 0px 0px;
    padding: 20px;
}
.menu{ 
          font-size: 20px;
        }  
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-light navbar-light">
    <div class="container-fluid">
    <a class="navbar-brand text-info" >
      <img class="rounded-circle" src="images/ac3.jpg" alt="Ac3" width="55px;">
      Ambedkar Community Center
    </a>      
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
<div class="btn-group">

  <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span>Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
  </button>
  <div class="dropdown-menu">
    <a href="reset-password.php" class="nav-link text-warning">
            <span class="btn btn-warning">Reset Password</span>
           
          </a>
    <div class="dropdown-divider"></div>
    <a href="logout.php" class="nav-link text-danger">
            <span class="btn btn-danger">Logout Out</span>
           
    </a>
</div>
</div>
         
</nav>
      <br>
      <p style="padding-top:20px">
  <button class="btn btn-info" data-toggle="collapse" href="#student" role="button" aria-expanded="false" aria-controls="collapseExample1">
  Student's Information
      </button>
      <button class="btn btn-info" data-toggle="collapse" href="#volunteer" role="button" aria-expanded="false" aria-controls="collapseExample1" style="margin-left:30px">
      Volunteer's Information
      </button>
</p>

    <br>
    
 


<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "ac3");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM student";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        ?>

<div class="container table-responsive-sm collapse" id="student">
<div class="page-header">
  
<hr class="bg-info">
      <h1>Student Information</h1>
    </div>
<table class="table table-hover">
  <thead>
    <tr style="background-color: #c3e6cb">
     <!-- <th scope="col">ID</th>-->
      <th scope="col">Student Name</th>
      <th scope="col">Date OF Birth</th>
      <th scope="col">Gender</th>
      <th scope="col">Education</th>
      <th scope="col">Parent Name</th>
      <th scope="col">Contact</th>
      <th scope="col">Address</th>
      <th scope="col">Occupation</th>
      <th scope="col">Family Education</th>
      <th scope="col">Income</th>
      <th scope="col">Other Information</th>
    </tr>
  </thead>




        <?php
        while($row = mysqli_fetch_array($result)){
        
            echo "<tbody>";
            echo "<tr>";
                //echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['edu'] . "</td>";
                echo "<td>" . $row['pname'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['ooc'] . "</td>";
                echo "<td>" . $row['fedu'] . "</td>";
                echo "<td>" . $row['income'] . "</td>";
                echo "<td>" . $row['other'] . "</td>";
            echo "</tr>";
            echo "</tbody>";
        }
        ?>
        
        </table>
      </div>
        
        
      
        <?php
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>




<?php
$link = mysqli_connect("localhost", "root", "", "ac3");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM volregister";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        ?>

<div class="container table-responsive-sm collapse" id="volunteer">
<div class="page-header">
  
<hr class="bg-info">
      <h1>Volunteer Information</h1>
    </div>
<table class="table table-hover">
  <thead>
    <tr style="background-color: #c3e6cb">
     <!-- <th scope="col">ID</th>-->
      <th scope="col">Volunteer Name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Date OF Birth</th>
      <th scope="col">Higher Occupation</th>
      <th scope="col">Contact</th>
      <th scope="col">Address</th>
    </tr>
  </thead>




        <?php
        while($row = mysqli_fetch_array($result)){
        
            echo "<tbody>";
            echo "<tr>";
                //echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['qualify'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['address'] . "</td>"; 
           
            echo "</tr>";
            echo "</tbody>";
        }
        ?>
        
        </table>
        
        
      
        <?php
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>