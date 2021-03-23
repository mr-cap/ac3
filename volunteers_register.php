<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $dob = $email = $contact = $qualify = $address = $password = $confirm_password = "";
$username_err= $dob_err = $email_err = $contact_err = $qualify_err = $address_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM volregister WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
}
    if(empty(trim($_POST["dob"]))){
        $dob_err = "Please enter a Date Of Birth.";     
    }else{
        $dob = trim($_POST["dob"]);
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a E-mail.";     
    }else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["contact"]))){
        $contact_err = "Please enter a contact.";     
    }else{
        $contact = trim($_POST["contact"]);
    }

    if(empty(trim($_POST["qualify"]))){
        $qualify_err = "Please enter a Qualification.";     
    }else{
        $qualify = trim($_POST["qualify"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a Address.";     
    }else{
        $address = trim($_POST["address"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($dob_err) && empty($email_err) && empty($contact_err) && empty($qualify_err) && empty($address_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO volregister (username, dob, email, contact, qualify, address, password) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssisss", $param_username,$param_dob,$param_email,$param_contact,$param_qualify,$param_address,$param_password);
            
            // Set parameters
            $param_username = $username;
            $param_dob = $dob;
            $param_email = $email;
            $param_contact = $contact;
            $param_qualify = $qualify;
            $param_address = $address;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            

            if($result){
                echo "Success";
            }
            else{
                echo "Error";
            }
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/bootstrap1.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  
    <style>
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
          <a href="index.html"><h1>Ambedkar Community Center</h1></a>
          
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
      <header>Volunteer Registration</header>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
                <label>Date Of Birth</label>
			    <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
                <span class="help-block"><?php echo $dob_err; ?></span>
			</div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-mail</label>
				<input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
			</div>
            <div class="form-group <?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
                <label>Contact</label>
				<input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>">
                <span class="help-block"><?php echo $contact_err; ?></span>
			</div>
            <div class="form-group <?php echo (!empty($qualify_err)) ? 'has-error' : ''; ?>">
                <label>Higher Qualification</label>
				<input type="text" name="qualify" class="form-control" value="<?php echo $qualify; ?>">
                <span class="help-block"><?php echo $qualify_err; ?></span>
			</div>			
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
				<input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
			</div>  
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group d-flex justify-content-center">
                <input type="submit" id="submit" class="btn btn-primary" style="margin-right:30px" value="Submit">
                <input type="reset" class="btn btn-danger" value="Reset">
            </div>
            <p class="form-group d-flex justify-content-center">Already have an account?<a href="login.php">  Login here</a>.</p>
        </form>
  
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