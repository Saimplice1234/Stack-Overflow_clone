<?php
session_start();
if($_SESSION['login'] == "false"){
	header("Location:./home.php");
}
$title="Ask";

include './header.php';


if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	try{
        
        $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";

		$question=trim(htmlspecialchars($_POST["question"]));
		$description=trim(htmlspecialchars($_POST["body"]));
		$tag=trim(htmlspecialchars($_POST["tag"]));
		$more=trim(htmlspecialchars($_POST["more"]));

		
		$dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
		$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
		$sth = $dbco->prepare('
		INSERT INTO post_b(question,tag,description,more,date)
		VALUES (:question,:tag,:description,:more,NOW())
	  ');
	  
		$sth->execute(array(
		   ':question' => $question,
		   ':tag' => $tag,
		   ':description' => $description,
		   ':more' => $more,

		));

	}
		  
	catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}
  }
  function getAvatar(){
    try{
        $userEmail=$_SESSION['userEmail'];
        $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
    
        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sth = $dbco->prepare("SELECT avatarUrl FROM logindata WHERE email='$userEmail'");
        $sth->execute();
        $result=$sth->fetchAll();
        $res=$result[0][0];
        echo'<img width="40" height="40" src="./avatar/'.$res.'">';
    }catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link href="./Forum __ Page d&#39;accueil_files/bootstrap.min.css" rel="stylesheet">
    <link href="./Forum __ Page d&#39;accueil_files/custom.css" rel="stylesheet">
    <link href="./Forum __ Page d&#39;accueil_files/css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./Forum __ Page d&#39;accueil_files/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./Forum __ Page d&#39;accueil_files/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="./Forum __ Page d&#39;accueil_files/settings.css" media="screen">
    <link type="text/css" rel="stylesheet" charset="UTF-8"
        href="./Forum __ Page d&#39;accueil_files/translateelement.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
</head>

<body>

<div class="container">
	<div class="row">
	    
	    <div class="col-md-8 col-md-offset-2">
	        
    		<h1>Create post</h1>
    		
    		<form action="./home.php" method="POST">
    		    
    		    <div class="form-group">
    		        <label for="question">Title <span class="require">*</span></label>
    		        <input type="text" class="form-control" name="question" placeholder="Question" required/>
    		    </div>
                <div class="form-group">
    		        <label for="tag">Tag<span class="require">*</span></label>
    		        <input type="text" class="form-control" name="tag" placeholder="Enregistrez sur un tag coherent pour votre question !" required/>
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="body">Body</label>
    		        <textarea rows="5" class="form-control" name="body" required></textarea>
    		    </div>
    		    
    		    <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
                <div class="form-group">
    		        <label for="more">More</label>
    		        <textarea rows="5" class="form-control" name="more" required></textarea>
    		    </div>
                <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		       
    		    </div>
    		    
    		</form>
    
		</div>
		
	</div>
</div>

    <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>

    <script type="text/javascript"
        src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.plugins.min.js.téléchargement"></script>
    <script type="text/javascript"
        src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.revolution.min.js.téléchargement"></script>

    <script src="./Forum __ Page d&#39;accueil_files/bootstrap.min.js.téléchargement"></script>
    <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>

</body>

</html>