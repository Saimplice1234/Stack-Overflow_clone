<?php

$servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
$errorMessage="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

try{
    
   $firstName=trim(htmlspecialchars($_POST["first"]));
   $name=trim(htmlspecialchars($_POST["name"]));
   $userMail=trim(htmlspecialchars($_POST["userMail"]));
   $userPass=trim(htmlspecialchars($_POST["userPassword"]));
   $userAvatar=$_FILES["file"]["name"];

   move_uploaded_file($_FILES["file"]["tmp_name"],"avatar/" . $userAvatar);

    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $dbco->prepare("SELECT email FROM logindata WHERE email='$userMail'");
    $sth->execute();

    $result = $sth->rowCount();

    if ($result> 0) {
        $errorMessage = "Email already taken";
    }else{

      $sth = $dbco->prepare("
      INSERT INTO logindata(first_name,name,email,password,avatarUrl)
      VALUES (:first_name,:name,:email,:password,:avatarUrl)
    ");
    
      $sth->execute(array(
        ':first_name'=>$firstName,
         ':name'=>$name,
         ':email'=>$userMail,
         ':password'=>$userPass,
         ':avatarUrl'=>$userAvatar,
      ));

      $errorMessage="You are registered successfuly !";

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
               <form action="register.php" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                     <label id="label--center">Enter your firstName</label>
                     <input type="text" class="form-control" placeholder="User FirstName" name="first" required>
                  </div>
               <div class="form-group">
                     <label id="label--center">Enter your name</label>
                     <input type="text" class="form-control" placeholder="username" name="name" required>
                  </div>
                  <div class="form-group">
                     <label id="label--center">Enter your email</label>
                     <input type="email" class="form-control" placeholder="User email" name="userMail" required>
                  </div>
                  <div class="form-group">
                     <label id="label--center">Enter your password</label>
                     <input type="password" class="form-control" placeholder="Password" name="userPassword" required>
                  </div>
                  <div class="form-group">
                     <label id="label--center">Enter your imageProfil</label>
                     <input type="file" class="form-control" placeholder="Password" name="file" required>
                  </div>
                  <button type="submit" class="btn btn-secondary">Register</button>
                  <br>
                  <br>
                  <br>

                  <?php if($errorMessage =="Email already taken"):?>
                  <div class="alert alert-danger" role="alert">
                    <?=$errorMessage?>
                   </div>
                   <?php endif;?>

                   <?php if($errorMessage == "You are registered successfuly !"):?>
                  <div class="alert alert-success" role="alert">
                    <?=$errorMessage?>
                    <a href="./home.php">Go to the home !</a>
                   </div>
                   <?php endif;?>

               </form>
            </div>
         </div>
      </div>

</body>
</html>