<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location:./index.php");
 }
require './header.php';

$_SESSION['id']=$_GET['id'];


function getIfConnect(){

    if($_SESSION['login'] == "false"){
         echo "<p id='enc'>Vous devez vous connecter pour repondre aux questions !</p>";
    }
}
function fetchByIdData(){
    $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
    $id=strip_tags($_SESSION['id']);  

       try{
    
        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sth = $dbco->prepare("SELECT question,tag,description,more,DAY(date) as d,MONTH(date) as m,YEAR(date) as y,more FROM post_b WHERE id='$id'");
        $sth->execute();
        $result =$sth->fetchAll();

        foreach($result as $data){

        echo'
        <div class="post beforepagination">
            <div class="topwrap">
                <div class="userinfo pull-left">
                    <div class="avatar">
                        
                    </div>
                  
                </div>
                <div class="posttext pull-left">
                    <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$data['question'].'</font></font></h2>
                    <div id="codeView"><p><font style="vertical-align: inherit;">'.$data['description'].'</font></p></div>
                    <div><p><font style="vertical-align: inherit;">'.$data['more'].'</font></p></div>
                    <span class="badge badge-pill badge-primary">
                    <font style="vertical-align: inherit;">
                    
                    <font id="tag"style="vertical-align: inherit;"\>'.$data['tag'].'</font>
                   </font>
                   </span>
                  <div class="posted pull-right"><i class="fa fa-clock-o"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Publie le '.$data['d'].'/'.$data['m'].'/'.$data['y'].'</font></font></div>
                   <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>                              
        </div>

        <div class="paginationf">
            <div class="pull-left"><a href="#" class="prevnext"><i ></i></a></div>
            
            <div class="pull-left"><a href="#" class="prevnext last"><i></i></a></div>
            <div class="clearfix"></div>
        </div>';
    }
        
      }catch(PDOException $e){
          echo "Erreur : " . $e->getMessage();
       }
}
function fecthResponse(){

    try{
$getId=$_SESSION['id'];


        $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
        $id=strip_tags($_SESSION['id']);  
      
      $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
      $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      $sth = $dbco->prepare("SELECT id,title,body,likeCount,dislikeCount,DAY(date) as d,MONTH(date) as m,YEAR(date) as y FROM response WHERE id='$id'");
      $sth->execute();
      $result = $sth->rowCount();
  
      if($result == 0){
        echo '<div id="response"><div class="alert alert-success" role="alert">
                    No response added !
            </div></div>';
      }else{
        $sth->execute();
        $result =$sth->fetchAll();

        foreach($result as $data){
            echo '
            <div class="post">
                <div class="topwrap">
                    <div class="userinfo pull-left">
                        <div class="avatar">
                          
                        </div>

                        
                    </div>
                    <div class="posttext pull-left">
                    <h4><font style="vertical-align: inherit;">'.$data['title'].'</font></h4>
                        <p><font style="vertical-align: inherit;">'.$data['body'].'</font></p>
                    </div>
                    <div class="clearfix"></div>
                </div>                              
                <div class="postinfobot">

    
                    <div class="posted pull-right"><i class="fa fa-clock-o"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Publié '.$data['d'].'/'.$data['m'].'/'.$data['y'].'</font></font></div>
                    <div class="posted pull-left">

                   <div class="like_dislike">
                   <ul>
                   <li>
                   <a href="./like.php?name='.$data['title'].'&id='.$id.'"> <i class="fa fa-thumbs-up" aria-hidden="true" class="up"></i>'.$data['likeCount'].'</a>
                    </li>
                    <li>
                    <a href="./dislike.php?name='.$data['title'].'&id='.$id.'"><i class="fa fa-thumbs-down" aria-hidden="true"></i>'.$data['dislikeCount'].'</a>
                    </li>
                    </ul>
                    </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>';
        }
        $sth->closeCursor();
      }
  
    }catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
     }
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
    try{
        $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
        $title=trim(htmlspecialchars($_POST["title"]));
        $body=trim(htmlspecialchars($_POST["body"]));
        
        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sth = $dbco->prepare("
          INSERT INTO response(id,title,body,likeCount,dislikeCount)
          VALUES (:id,:title,:body,:likeCount,:dislikeCount)
        ");
        
        $sth->execute(array(
            ':id' =>$_SESSION['id'],
             ':title' => $title,
             ':body' => $body,
             ':likeCount' =>0,
             ':dislikeCount' =>0,

            
            ));

        $isSubmit=true;
    }  
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
  }

function createForm(){
 
    if($_SESSION['login']=="true"){
        echo '
        <div class="post">
            <form action="./deletePostDataView.php?id='.$_SESSION['id'].'" class="form" method="post">
                <div class="topwrap">
                    <div class="userinfo pull-left">
                
                        <div class="icons">
                            <img src="./viewerPost_files/icon3.jpg" alt=""><img src="./viewerPost_files/icon4.jpg" alt=""><img src="./viewerPost_files/icon5.jpg" alt=""><img src="./viewerPost_files/icon6.jpg" alt="">
                        </div>
                    </div>
                    <div class="posttext pull-left">
                    <div class="textwraper">
                            <div class="postreply"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Donner le nom de votre reponse</font></font></div>
                            <textarea name="title" id="reply" placeholder="Donner le nom de votre response" required></textarea>
                        </div>
                        <div class="textwraper">
                            <div class="postreply"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">poster une réponse</font></font></div>
                            <textarea name="body" id="reply" placeholder="tapez le corps de votre reponse" required></textarea>
                        </div>
                    </div>
                </div>                              
                <div class="postinfobot">
                  
                    <div class="pull-right postreply">
                        <div class="pull-left"><button id="sts"type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Poster une réponse</font></font></button></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>



                </div>
            </form>
        </div>';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./Forum __ Page d&#39;accueil_files/bootstrap.min.css" rel="stylesheet">
    <link href="./Forum __ Page d&#39;accueil_files/custom.css" rel="stylesheet">
    <link href="./Forum __ Page d&#39;accueil_files/css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./Forum __ Page d&#39;accueil_files/font-awesome.min.css">
    <link href="./viewerPost_files/bootstrap.min.css" rel="stylesheet">
    <link href="./viewerPost_files/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./Forum __ Page d&#39;accueil_files/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="./Forum __ Page d&#39;accueil_files/settings.css" media="screen">
    <link href="./viewerPost_files/css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./viewerPost_files/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./viewerPost_files/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="./viewerPost_files/settings.css" media="screen">
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="./viewerPost_files/translateelement.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

    <style>
    #codeView {
        width: 100%;
        height: max-content;
        background: #eafeff;
        border-radius: 6px;
    }

    #codeView p {
        padding: 10px;
    }

    #spacer {
        width: 50px;
    }

    #notLog {
        width: 40px;
        height: 40px;
    }

    #user_icn {

        text-decoration: none;
    }

    a {
        text-decoration: none;

    }

    #aa {
        text-decoration: none;
    }
    .spacer{
        margin-top:1%;
      }

        #aa{
          color:white;
          text-decoration:none;
        }
        #notLog{
          width:40px;
          height:40px;
        }
        #user_icn{
          text-decoration:none;
        }
        #category{
            position:absolute;
            left:-32%;
            width:120px;
            margin-top:1%;
        }
        .like_dislike{
            margin-top:1%;
        }
        .like_dislike ul{
            display:inline-flex;
            list-style:none;
        }
        .like_dislike ul li{
            padding:5px;
            cursor:pointer;
        }
        .like_dislike ul li:nth-child(1){
            margin-top:-4%;
        
        }
        #sts{
            margin-bottom:8%;
        }
        #enc{
            height:20%;
        }
        body{
            background:whitesmoke;
        }
    </style>
</head>

<body class="topic">

    <div class="container-fluid">
   
     


        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 breadcrumbf">
                        <a href="./home.php">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Home</font>
                            </font>
                        
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col-lg-16 col-md-16">

                        <?php fetchByIdData();?>
                        <?php fecthResponse();?>
                        <?php createForm(); ?>


                    </div>
                    
                </div>
                <?=getIfConnect();?>
            </div>



        </section>

    </div>

    <!-- get jQuery from the google apis -->
    <script type="text/javascript" src="./viewerPost_files/jquery.js.téléchargement"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="./viewerPost_files/jquery.themepunch.plugins.min.js.téléchargement"></script>
    <script type="text/javascript" src="./viewerPost_files/jquery.themepunch.revolution.min.js.téléchargement"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./viewerPost_files/bootstrap.min.js.téléchargement"></script>


    <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
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

    }); //ready
    </script>

    <!-- END REVOLUTION SLIDER -->
    <div id="goog-gt-tt" class="skiptranslate" dir="ltr">
        <div style="padding: 8px;">
            <div>
                <div class="logo"><img src="./viewerPost_files/translate_24dp.png" width="20" height="20"
                        alt="Google Traduction"></div>
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
        <div class="goog-te-spinner-animation">
            <svg xmlns="http://www.w3.org/2000/svg" class="goog-te-spinner" width="96px" height="96px"
                viewBox="0 0 66 66">
                <circle class="goog-te-spinner-path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33"
                    r="30">
                </circle>
            </svg>
        </div>
    </div>
</body>

</html>