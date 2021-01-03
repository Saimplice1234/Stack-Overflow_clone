<?php
session_start();
if(!isset($_SESSION['login'])){
   header("Location:./index.php");
}
$title="Home";
include './header.php';

function fetchAllData(){
  $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";

  try{

  class _SYSTEM_COUNT{

  public function getCountResponse($id){  

    $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
    
       $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sth = $dbco->prepare("SELECT * FROM response WHERE id='$id'");
        $sth->execute();
        $result = $sth->rowCount();
        return $result;
    }
 }

     $initCount = new _SYSTEM_COUNT();

  
      $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
      $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sth = $dbco->prepare("SELECT id,question,tag,DAY(date) as d,MONTH(date) as m,YEAR(date) as y,more FROM post_b");
      $sth->execute();
      $result =$sth->fetchAll();
     
      $count = $sth->rowCount();

    if($count !=0){
    foreach($result as $data){
       
        echo "<div class='post'>
        <div class='wrap-ut pull-left'>
            <div class='userinfo pull-left'>
                <div class='avatar'>
                    
                </div>
                <div class='icons'>
                </div>
            </div>
            <div class='posttext pull-left'>
                <h2>
                        <font style='vertical-align: inherit;'>
                            <font style='vertical-align: inherit;'>
                            <a href='./view.php?id=".$data['id']."'>".$data['question']."</a>
                            </font>
                        </font>
                    </a></h2>
                <p>
                    <font style='vertical-align: inherit;'>
                        <font style='vertical-align: inherit;'>
                        ".$data['more']."
                        </font>
                    </font>
                </p>
                <span class='badge badge-pill badge-primary'>
                        <font style='vertical-align: inherit;'>
                        <font style='vertical-align: inherit;'\>".$data['tag']."</font>
                    </font>
                </span>
            </div>
            
            <div class='clearfix'></div>
        </div>
        <div class='postinfo pull-left'>
            <div class='comments'>
                <div class='commentbg'>
                    <font style='vertical-align: inherit;'>
                        <font style='vertical-align: inherit;'>
                            {$initCount->getCountResponse($data['id'])}
                        </font>
                    </font>
                    <div class='mark'></div>
                </div>

            </div>
        
            <div class='time'><i class='fa fa-clock-o'></i>
                <font style='vertical-align: inherit;'>
                    <font style='vertical-align: inherit;''>Publie le ".$data['d']."/".$data['m']."/".$data['y']."</font>
                </font>
            </div>
        </div>
        <div class='clearfix'></div>
    </div>";
    

      }
    }else{
        echo "<p id='noting'>Pas de question disponible !</p>";
        if($_SESSION['login']=="true"){
            echo "<a id='redirec' href='./postCreation.php'>Allez vers la creation de poste pour creer des questions!Cliquez sur ce lien</a>";

        }else if($_SESSION['login']=="false"){
           echo "<a id='redirec' href='./login.php'>Connectez vous pour creer des questions !Cliquez sur ce lien</a>";

        }

    }


    }catch(PDOException $e){
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
<style>
    .content,body{
        background:whitesmoke;
    }
    .spacer {
        margin-top: 1%;
    }

    #aa {
        color: white;
        text-decoration: none;
    }

    #notLog {
        width: 40px;
        height: 40px;
    }

    #user_icn {
        text-decoration: none;
    }

    #category {
        position: absolute;
        left: -32%;
        width: 120px;
        margin-top: 1%;
    }
    #sp{
        height:0px;
    }
    #noting{
        position: absolute;
        left:50%;
        top:50%;
        transform:translate(-50%,-50%);
        font-size:23px;
    }
    #redirec{
        position: absolute;
        left:50%;
        top:60%;
        transform:translate(-50%,-50%);
        font-size:14px;
        cursor:pointer;
    }
    </style>

</head>

<body>

    <div class="container-fluid">

      

        <section class="content">
            <div class="spacer"></div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-16 col-md-16">
                        <!-- POST -->
                        <?php fetchAllData(); ?>
                        <!-- POST -->
                    </div>

                </div>
            </div>
        </section>


        <div id="sp"></div>



    <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>

    <script type="text/javascript"
        src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.plugins.min.js.téléchargement"></script>
    <script type="text/javascript"
        src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.revolution.min.js.téléchargement"></script>

    <script src="./Forum __ Page d&#39;accueil_files/bootstrap.min.js.téléchargement"></script>

    <script type="text/javascript">
    var revapi;

    jQuery(document).ready(function() {
        "use strict";
        revapi = jQuery('.tp-banner').revolution({
            delay: 15000,
            startwidth: 1200,
            startheight: 278,
            hideThumbs: 10,
            fullWidth: "on"
        });

    });
    </script>

    <div id="goog-gt-tt" class="skiptranslate" dir="ltr">
        <div style="padding: 8px;">
            <div>
                <div class="logo"><img src="./Forum __ Page d&#39;accueil_files/translate_24dp.png" width="20"
                        height="20" alt="Google Traduction"></div>
            </div>
        </div>
        <div class="top" style="padding: 8px; float: left; width: 100%;">
            <h1 class="title gray">Texte d'origine</h1>
        </div>
        <div class="middle" style="padding: 8px;">
            <div class="original-text"></div>
        </div>
        <div class="bottom" style="padding: 8px;">
            <div class="activity-links"><span class="activity-link">Proposer une meilleure traduction</span><span
                    class="activity-link"></span></div>
            <div class="started-activity-container">
                <hr style="color: #CCC; background-color: #CCC; height: 1px; border: none;">
                <div class="activity-root"></div>
            </div>
        </div>
        <div class="status-message" style="display: none;"></div>
    </div>

    <div class="goog-te-spinner-pos">
        <div class="goog-te-spinner-animation"><svg xmlns="http://www.w3.org/2000/svg" class="goog-te-spinner"
                width="96px" height="96px" viewBox="0 0 66 66">
                <circle class="goog-te-spinner-path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33"
                    r="30"></circle>
            </svg></div>
    </div>
    <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>

<script type="text/javascript"
    src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.plugins.min.js.téléchargement"></script>
<script type="text/javascript"
    src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.revolution.min.js.téléchargement"></script>

<script src="./Forum __ Page d&#39;accueil_files/bootstrap.min.js.téléchargement"></script>
        <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>
    <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>

<script type="text/javascript"
    src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.plugins.min.js.téléchargement"></script>
<script type="text/javascript"
    src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.revolution.min.js.téléchargement"></script>

<script src="./Forum __ Page d&#39;accueil_files/bootstrap.min.js.téléchargement"></script>
        <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>
</body>

</html>