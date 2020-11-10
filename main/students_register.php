<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username=$dob=$gender=$edu=$pname=$contact=$address=$ooc=$fedu=$income=$other="";
$username_err=$dob_err=$gender_err=$edu_err=$pname_err=$contact_err=$address_err=$ooc_err=$fedu_err=$income_err=$other_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }else{
      $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["dob"]))){
        $dob_err = "Please enter a Date Of Birth.";     
    }else{
        $dob = trim($_POST["dob"]);
    }

    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please enter gender.";     
    }else{
        $gender = trim($_POST["gender"]);
    }

    if(empty(trim($_POST["edu"]))){
      $edu_err = "Please enter a Education Qualification.";     
    }else{
      $edu = trim($_POST["edu"]);
    }

    if(empty(trim($_POST["pname"]))){
      $pname_err = "Please enter Parent Name.";     
    }else{
      $pname = trim($_POST["pname"]);
    }

    if(empty(trim($_POST["contact"]))){
        $contact_err = "Please enter a contact.";     
    }else{
        $contact = trim($_POST["contact"]);
    }

    if(empty(trim($_POST["ooc"]))){
        $ooc_err = "Please enter a Occupation.";     
    }else{
        $ooc = trim($_POST["ooc"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a Address.";     
    }else{
        $address = trim($_POST["address"]);
    }
    
    if(empty(trim($_POST["fedu"]))){
      $fedu_err = "Please enter a Occupation.";     
    }else{
      $fedu = trim($_POST["fedu"]);
    }
    
    if(empty(trim($_POST["income"]))){
        $income_err = "Please enter a Family Income.";     
    }else{
        $income = trim($_POST["income"]);
    }
    if(empty(trim($_POST["other"]))){
      $other_err = "Please enter a Other Information.";     
    }else{
      $other = trim($_POST["other"]);
    }
    
  
    
    // Check input errors before inserting in database
if(empty($username_err) && empty($dob_err) && empty($gender_err) && empty($edu_err) && empty($pname_err) && empty($contact_err) && empty($address_err) && empty($occ_err) && empty($fedu_err) && empty($income_err) && empty($other_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO student (username,dob,gender,edu,pname,contact,address,ooc,fedu,income,other) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssisssis", $param_username,$param_dob,$param_gender,$param_edu,$param_pname,$param_contact,$param_address,$param_ooc,$param_fedu,$param_income,$param_other);
            
            // Set parameters
            $param_username = $username;
            $param_dob = $dob;
            $param_gender = $gender;
            $param_edu = $edu;
            $param_pname = $pname;
            $param_contact = $contact;
            $param_address = $address;
            $param_ooc = $ooc;
            $param_fedu = $fedu;
            $param_income = $income;
            $param_other = $other;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               // header("location: index.html");
               header("location: index.html");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
   
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/bootstrap1.css" >
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <style>
   

form{
    width: 50%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid transparent;
    background: transparent;
    border: 0px 0px 10px 10px;
}
        .menu{ 
          font-size: 20px;
        }  
        </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand text-info" href="#" >
      <img class="rounded-circle" src="images/ac3.jpg" alt="Ac3" width="55px;">
    </a>
    <a href="index.html"><header>Ambedkar Community Center</header></a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="collapsibleNavbar">
      <ul class="navbar-nav d-flex justify-content-center flex-col ml-md-auto">
        <li class="nav-item active">
            <a href="index.html" class="nav-link text-info"><span class="menu">
              <i class="fa fa-home" aria-hidden="true"> Home</span></i>
            </a>
        </li>
      </ul>  
    </div> 
  </div>
</nav>

<header>Student Registration Form</header>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
      <label>Student Name</label>
      <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"> 
      <span class="help-block"><?php echo $username_err; ?></span>
  </div>  
  <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
      <label>Date Of Birth</label>
			<input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
      <span class="help-block"><?php echo $dob_err; ?></span>
	</div>
  <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
      <label>Gender</label>
			<input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
      <span class="help-block"><?php echo $gender_err; ?></span>
  </div>
  <div class="form-group <?php echo (!empty($edu_err)) ? 'has-error' : ''; ?>">
      <label>School Name</label>
			<input type="text" name="edu" class="form-control" value="<?php echo $edu; ?>">
      <span class="help-block"><?php echo $edu_err; ?></span>
  </div>
  <div class="form-group <?php echo (!empty($pname_err)) ? 'has-error' : ''; ?>">
      <label>Parent Name</label>
			<input type="text" name="pname" class="form-control" value="<?php echo $pname; ?>">
      <span class="help-block"><?php echo $pname_err; ?></span>
	</div>
  <div class="form-group <?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
      <label>Parent Contact Number</label>
			<input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>">
      <span class="help-block"><?php echo $contact_err; ?></span>
	</div>			
  <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
      <label>Residential Address</label>
			<input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
      <span class="help-block"><?php echo $address_err; ?></span>
  </div>
  <div class="form-group <?php echo (!empty($ooc_err)) ? 'has-error' : ''; ?>">
      <label>Education Standard</label>
		  <input type="text" name="ooc" class="form-control" value="<?php echo $ooc; ?>">
      <span class="help-block"><?php echo $ooc_err; ?></span>
	</div>  
  <div class="form-group <?php echo (!empty($fedu_err)) ? 'has-error' : ''; ?>">
      <label>Family Education Background</label>
      <input type="text" name="fedu" class="form-control" value="<?php echo $fedu; ?>">
      <span class="help-block"><?php echo $fedu_err; ?></span>
  </div>
  <div class="form-group <?php echo (!empty($income_err)) ? 'has-error' : ''; ?>">
      <label>Family Income</label>
			<input type="text" name="income" class="form-control" value="<?php echo $income; ?>">
      <span class="help-block"><?php echo $income_err; ?></span>
	</div>
      <div class="form-group <?php echo (!empty($other_err)) ? 'has-error' : ''; ?>">
      <label>Other Information</label>
      <input type="text" name="other" class="form-control" value="<?php echo $other; ?>">
      <span class="help-block"><?php echo $other; ?></span>
  </div>
  <div class="form-group d-flex justify-content-center">
      <input type="submit" class="btn btn-primary" style="margin-right:30px" value="Submit">
      <input type="reset" class="btn btn-danger" value="Reset">
  </div>
  
</form>




<!-- Footer -->

<hr class="bg-info">
<footer class="page-footer  bg-light"> 
  <div class="container text-center text-md-left">
    <div class="row text-center text-xs-center text-sm- text-md-left">
      <div class="col-md-4 mr-auto">
        <h4 class="font-weight-bold text-uppercase mt-3 mb-4">Address</h4>
        <address class="text-capitalize">
          <p><strong>AC3</strong><br>
            1st Main, 2nd Cross, Sudharshan Layout, NG Palya,<br> Near Shobha Mangolia, Bannerghatta Road, Bangalore-560029
          </p>
          <p><a href="https://www.openstreetmap.org/node/2470953886" target="_blank" class="btn btn-success">Get Location</a></p>
        </address>
      </div>   
      <div class="col-md-4 mr-auto">
        <h4 class="font-weight-bold text-uppercase mt-3 mb-4">Contact</h4>
        <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:contact@fsmk.org"><span style="color:rgb(54, 203, 211)"> contact@fsmk.org</span></a></p>
        <p><i class="fa fa-phone" aria-hidden="true"></i><span> Renuka : </span> +91 8884946518</p> 
        <p><i class="fa fa-phone" aria-hidden="true"></i><span> VinodKumar : </span> +91 8904726417</p> 
        <p><i class="fa fa-phone" aria-hidden="true"></i><span> Prabhakaran : </span> +91 6360297229</p>  
      </div>
    </div>
    
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>
</html>