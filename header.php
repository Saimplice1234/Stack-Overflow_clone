
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    #sea{
        height:39px;
    }
    .headernav{
        background:white;
    }
    </style>

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
                                    
                                    <button id="sea" class="btn btn-default" type="submit"><i
                                            class="fa fa-search"></i></button>
                                </div>
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
                           
                            <a data-toggle="dropdown" id="user_icn">

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
                                        href="./register.php">
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


        <script type="text/javascript" src="./Forum __ Page d&#39;accueil_files/jquery.js.téléchargement"></script>

<script type="text/javascript"
    src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.plugins.min.js.téléchargement"></script>
<script type="text/javascript"
    src="./Forum __ Page d&#39;accueil_files/jquery.themepunch.revolution.min.js.téléchargement"></script>

<script src="./Forum __ Page d&#39;accueil_files/bootstrap.min.js.téléchargement"></script>
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