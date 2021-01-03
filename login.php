<?php

session_start();
$_SESSION['login']='false';
$_SESSION['userEmail']="";

$servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
$errorMessage="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

try{
    
    $userMail=trim(htmlspecialchars($_POST["userMail"]));
    $userPass=trim(htmlspecialchars($_POST["userPassword"]));
    
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $dbco->prepare("SELECT email FROM logindata WHERE email='$userMail'");
    $sth->execute();

    $result = $sth->rowCount();

    if ($result> 0) {

      $getPass = $dbco->prepare("SELECT password FROM logindata WHERE email='$userMail'");
      $getPass->execute();

      $getAvatar=$dbco->prepare("SELECT * FROM logindata WHERE email='$userMail'");
      $getAvatar->execute();
      $result2 =$getPass->fetchAll();
      $result3 =$getAvatar->fetchAll();
  
      $_SESSION["userEmail"]=$result3[0]["email"];
      
      if($result2[0][0] == $userPass){

          $_SESSION['login']='true';
          header("Location:./home.php");

      }else{
         $errorMessage="Wrong password or email";
      }

    }else{
        $errorMessage="You are not a member register please!";
    }
}
      
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="./styles/style.css"/>

</head>
<body>
  
<div class="sidenav">
         <div class="login-main-text">
            <h2>Clone Stack Overflow</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="./login.php" method="POST">
                  <div class="form-group">
                     <label id="label--center">Enter your email</label>
                     <input type="email" class="form-control" placeholder="User email" name="userMail" required>
                  </div>
                  <div class="form-group">
                     <label id="label--center">Enter your password</label>
                     <input type="password" class="form-control" placeholder="Password" name="userPassword" required>
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                  <button id="registerBtn" class="btn btn-secondary" href="register.php">Register</button>

                  <br>
                  <br>
                  <br>

                  <?php if($errorMessage =="You are not a member register please!" || $errorMessage=="Wrong password or email"):?>
                  <div class="alert alert-danger" role="alert">
                    <?=$errorMessage?>
                   </div>
                   <?php endif;?>

                   <?php if($errorMessage == "Log in"):?>
                  <div class="alert alert-success" role="alert">
                    <?=$errorMessage?>
                   </div>
                   <?php endif;?>

               </form>
            </div>
         </div>
      </div>
      <script src="./script/script.js"></script>
</body>
</html>