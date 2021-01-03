<?php
session_start();
$nameResponse=$_GET['name'];
$pickIdUrl=$_GET['id'];
$servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
   
    try{

        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $sth = $dbco->prepare("UPDATE response set dislikeCount=dislikeCount+1 WHERE title='$nameResponse'");                 
        $sth->execute();
        $sth->closeCursor();
       header("Location:./view.php?id=$pickIdUrl");
  
      }catch(PDOException $e){
          echo "Erreur : " . $e->getMessage();
    }

?>
