<?php
session_start();

function fetchResponse(){
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
        
        $mode=$_GET['tag'];
        $query=$_GET['query'];

        $servname = "localhost"; $dbname = "stack"; $user = "root"; $pass = "";
        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($mode == "Tag"){

            $sth = $dbco->prepare("SELECT * FROM post_b WHERE tag LIKE '%$query%'");
            $sth->execute();
            $result =$sth->fetchAll();
            $count = $sth->rowCount();

       if($count != 0){
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
            <div class='views'><i class='fa fa-eye'></i>
                <font style='vertical-align: inherit;'>
                    <font style='vertical-align: inherit;'> 1 568</font>
                </font>
            </div>
            <div class='time'><i class='fa fa-clock-o'></i>
                <font style='vertical-align: inherit;'>
                    <font style='vertical-align: inherit;''> 24 min</font>
                </font>
            </div>
        </div>
        <div class='clearfix'></div>
       </div>";
    

     }
    }else{
        echo "<p id='result'>No result</p>";
    }

    }else if($mode == "Nom"){
         
            $sth = $dbco->prepare("SELECT * FROM post_b WHERE question LIKE '%$query%'");
            $sth->execute();
            $result =$sth->fetchAll();
            $count = $sth->rowCount();
    if($count !=0){
      foreach($result as $data){

        
        echo "<div class='post'>
        <div class='wrap-ut pull-left'>
            <div class='userinfo pull-left'>
                <div class='avatar'>
                    <img src='./Forum __ Page d&#39;accueil_files/avatar.jpg'>
                    <div class='status green'>&nbsp;</div>
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
                            0
                        </font>
                    </font>
                    <div class='mark'></div>
                </div>

            </div>
            <div class='views'><i class='fa fa-eye'></i>
                <font style='vertical-align: inherit;'>
                    <font style='vertical-align: inherit;'> 1 568</font>
                </font>
            </div>
            <div class='time'><i class='fa fa-clock-o'></i>
                <font style='vertical-align: inherit;'>
                    <font style='vertical-align: inherit;''> 24 min</font>
                </font>
            </div>
        </div>
        <div class='clearfix'></div>
       </div>";
    

       }
    }else{
        echo "<p id='result'>No result</p>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <style>

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
  #result{
      font-size:57px;
      position:absolute;
      left:50%;
      top:-18%;
      transform:translate(-50%,-50%);
      margin-top:30%;
      font-weight:lighter;
  }
  body{
        background:whitesmoke;
  }
  .headernav{
      background:white;
  }
  </style>
</head>
<body>

    <div class="container-fluid">

        <div class="headernav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a
                            href="./home.php"><img
                                src="./Forum __ Page d&#39;accueil_files/logo.jpg" alt=""></a></div>
                    <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                      <?php echo "StackFire" ?>
                    </div>
                    <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                        <div class="wrap">
                            
                            <form action="./searchView.php" method="get" class="form">
                                <div class="column">

                                <select name="tag" id="category" class="form-control" required>
											<option value="" disabled="" selected=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mode</font></font></option>
											<option value="Tag"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tag</font></font></option>
											<option value="Nom"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nom</font></font></option>
										
                                </select>
                                
                                <div class="pull-left txt">
                                
                                    <input type="text" class="form-control"
                                        placeholder="Rechercher des sujets" name="query" required></div>
                                <div class="pull-right" >
                                    
                                    <button class="btn btn-default" type="submit"><i
                                            class="fa fa-search"></i></button></div>
                                <div class="clearfix"></div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                        <div class="stnt pull-left">
                            <div class="form">
                                <button type="button" class="btn btn-primary" href="./postCreation.php"
                                  <?=($_SESSION['login'] == "false")?"disabled":""?>
                                >
            
                                    <a href="./postCreation.php"  id="aa">Poser une question</a>
                                  
                                </button>
                            </div>
                        </div>
                        <div class="env pull-left"><p></p></div>

                        <div class="avatar pull-left dropdown">
                           
                            <a data-toggle="dropdown" id="user_icn" href="http://forum.azyrusthemes.com/#">

                      <?php if(isset($_SESSION['login']) && $_SESSION['login'] == "true"):?>
              
                        <?php getAvatar(); ?>
                      
                      
                       
                      <?php endif;?>

                      <?php if(isset($_SESSION['login']) && $_SESSION['login'] == "false"):?>
                        <img  id="notLog" src="./Forum __ Page d&#39;accueil_files/user.jpg" alt="">
                      <?php endif;?>
                          
        
                          </a> 
                          <b
                                class="caret"></b>

                                <?php if(isset($_SESSION['login']) && $_SESSION['login'] == "true"):?>
              
                                 <div class="status green">&nbsp;</div>
               
                               <?php endif;?>

                               <?php if(isset($_SESSION['login']) && $_SESSION['login'] == "false"):?>
              
                            <div class="status red">&nbsp;</div>

                              <?php endif;?>

                            <ul class="dropdown-menu" role="menu">
                            
                                    <?php if(isset($_SESSION['login']) && $_SESSION['login']=="true"):?>
              
                                     <li role="presentation"><a role="menuitem" tabindex="-3"
                                        href="./disconnect.php">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Se deconnecter</font>
                                        </font>
                                    </a></li>
               
                                  <?php endif;?>

                              <?php if(isset($_SESSION['login']) && $_SESSION['login']=="false"):?>
              
                                <li role="presentation"><a role="menuitem" tabindex="-3"
                                      href="./login.php">
                                <font style="vertical-align: inherit;">
                                  <font style="vertical-align: inherit;">Se connecter</font>
                                 </font>
                                </a></li>
                                <?php endif;?>
                                
                                <li role="presentation"><a role="menuitem" tabindex="-4"
                                        href="http://forum.azyrusthemes.com/04_new_account.html">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Créer un compte</font>
                                        </font>
                                    </a></li>
                                
                            </ul>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
           <div class="spacer"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-16 col-md-16">
                        <!-- POST -->
                          <?php fetchResponse(); ?>
                        <!-- POST -->
                    </div>
                    <div class="col-lg-4 col-md-4">
                       
                      


                    </div>
                </div>
            </div>
        </section>


    

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
</body>
</html>