<?php

//start session
session_start();

//include required files
include('config.php');
include('includes/ORM.class.php');
require_once('twitteroauth/twitteroauth.php');

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Infinix Zero - Designed in France</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" href="favicon.ico" type="image/gif">
        <link rel="stylesheet" href="css/main.css">
        <script>
            var BASE_URL = '<?php echo BASE_URL; ?>';
        </script>
        <script src="js/vendor/modernizr-2.7.1.min.js"></script>



    </head>
    <body class="loading">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Load Facebook SDK -->
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '302265009952038',
                    xfbml      : true,
                    version    : 'v2.0'
                });

                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        // the user is logged in and has authenticated your
                        // app, and response.authResponse supplies
                        // the user's ID, a valid access token, a signed
                        // request, and the time the access token
                        // and signed request each expire
                        var uid = response.authResponse.userID;

                        $.ajax({
                            url:BASE_URL+'/ajax.php',
                            type:'post',
                            data:{'uid':uid,'task':'fbinit'},
                            beforeSend:function(){
                                console.log('get share count' + uid);
                            }
                        }).success(function(response){
                            var data = JSON.parse(response);
                            if(data.code == '000'){
                                $('#counter').empty().html(data.desc);
                            }else{
                            	  $('#counter').empty().html('<?php echo SHARE_COUNT; ?>');
                                console.error(data.desc);
                            }
                            console.log(response);
                        }).error(function(response){
                            console.error(response);

                        })


                    }else {
                    		$('#counter').empty().html('<?php echo SHARE_COUNT; ?>');
                    }
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));


            //get logged in user

        </script>
        <!-- Facebook SDK -->
      
      <div class="nav-container">
          <div class="mobile-menu">
              <ul>
                <li><a href="index.php">ABOUT</a></li>
                <li><a href="pre-order.php">PRE-ORDER</a></li>
                <li><a href="share.php" class="current">SHARE</a></li>
              </ul>
          </div>
      </div>

      <div class="container-main">

       	<div class="main-header">
       		<div class="wrap">
         		<a href="index.php" class="infinix-logo">
     				   	<img src="img/infinix_logo.png" alt="">
     				 </a>
            <div class="menu-icon"></div>

     				<div class="menu">
     					<div class="vertical-align">
     						<ul>
  							<li><a href="index.php">ABOUT</a></li>
  							<li><a href="pre-order.php">PRE-ORDER</a></li>
  							<li><a href="share.php" class="current">SHARE</a></li>
  						</ul>
  						<br style="clear:left"/>
     					</div>
  					
  				</div>

       		</div>
       	</div>
       	  <div id="share-page">
                <div class="page-bg"></div>
               <div class="content-main">
                <div class="wrap">
                  <div class="share-main">
                    <div class="vertical-align">
                      <h1>KEEP SHARING TO UNLOCK <br>THE INFINIX ZERO</h1>
                      <div class="share-block">
                          <h4>ONLY:</h4>
                          <h3 id="counter"></h3>
                          <h4>SHARES TO GO</h4>
                      </div>
                      <div class="intro-p">
                        The Infinix Zero is here and we’re giving you the chance  to pre-order it at an unbelievable price.
                      </div>
                      <div class="steps-main">
                          <div class="single-step">
                            <h4>Share the <br> promo</h4>
                            <p>
                              Share this promo with your friends
                            </p>
                          </div>

                          <div class="single-step">
                            <h4>Drop the <br>countdown to ZERO</h4>
                            <p>
                              The more shares the the faster the drop
                            </p>
                          </div>

                          <div class="single-step">
                            <h4>Make your <br> pre-order</h4>
                            <p>
                               Pre-order your very own Infinix Zero
                            </p>
                          </div>
                      </div>
                      <div class="btn-main">
                        <div id="fb-root"></div>
                        <a href="javascript:shareOnFacebook();" class="fb-share" id="fb-share">
                          <img src="img/fb-share.png" alt="">
                        </a>
                        <?php
                        	/* If access tokens are not available redirect to connect page. */
									if (empty($_SESSION['twitter_id']) || $_SESSION['twitter_id'] == 0 || empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    							?>
    								<a href="<?php echo BASE_URL; ?>/connect.php"  class="twitter-share">
                         		 <img src="img/twitter-share.png" alt="">
                        	</a>
    							<?php
									}else {
										
										//print_r($_SESSION);
										
								?>
                        	<a href="https://twitter.com/intent/tweet?text=<?php echo TWITTER_TEXT ; ?>&url=<?php echo TWITTER_URL ; ?>" class="twitter-share">
                          		<img src="img/twitter-share.png" alt="">
                        	</a>
                       <?php
                       		}
                       ?>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
          </div>
       	 
       	 <!-- <div id="share-page">
                <div class="page-bg"></div>
               <div class="content-main">
                <div class="wrap">
                  <div class="share-main">
                    <div class="vertical-align">
                      <h1>KEEP SHARING TO UNLOCK <br>THE INFINIX ZERO</h1>
                      <div class="share-block">
                          <h4>ONLY:</h4>
                          <h3 id="counter"></h3>
                          <h4>SHARES TO GO</h4>
                      </div>
                      <div class="intro-p">
                        The Infinix Zero is here and we’re giving you the chance  to pre-order it at an unbelievable price.
                      </div>
                      <div class="steps-main">
                          <div class="single-step">
                            <h4>Share the <br> promo</h4>
                            <p>
                              Share this promo with your friends
                            </p>
                          </div>

                          <div class="single-step">
                            <h4>Drop the <br>countdown to ZERO</h4>
                            <p>
                              The more shares the the faster the drop
                            </p>
                          </div>

                          <div class="single-step">
                            <h4>Make your <br> pre-order</h4>
                            <p>
                               Pre-order your very own Infinix Zero
                            </p>
                          </div>
                      </div>
                      <div class="btn-main">
                        <div id="fb-root"></div>
                        <a href="javascript:shareOnFacebook();" class="fb-share" id="fb-share">
                          <img src="img/fb-share.png" alt="">
                        </a>
                        <?php
                        	/* If access tokens are not available redirect to connect page. */
									if (empty($_SESSION['twitter_id']) || $_SESSION['twitter_id'] == 0 || empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    							?>
    								<a href="<?php echo BASE_URL; ?>/connect.php"  class="twitter-share">
                         		 <img src="img/twitter-share.png" alt="">
                        	</a>
    							<?php
									}else {
										
										//print_r($_SESSION);
										
								?>
                        	<a href="https://twitter.com/intent/tweet?text=<?php echo TWITTER_TEXT ; ?>&url=<?php echo TWITTER_URL ; ?>" class="twitter-share">
                          		<img src="img/twitter-share.png" alt="">
                        	</a>
                       <?php
                       		}
                       ?>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
          </div> -->

        </div>
        <script>
            window.twttr = (function (d, s, id) {
                var t, js, fjs = d.getElementsByTagName(s)[0];

                if (d.getElementById(id)) return;

                js = d.createElement(s); js.id = id; js.src= "https://platform.twitter.com/widgets.js";

                fjs.parentNode.insertBefore(js, fjs);

                return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });

            }(document, "script", "twitter-wjs"));
            
        </script>
        <script src="js/vendor/jquery-1.9.1.min.js"></script>
        <script src="js/imagesloaded.js"></script>
        <script src="js/skrollr.js"></script>
        <script src="js/_main.js"></script>
        <script src="js/allscript.js"></script>
        <script src="js/share.js"></script>

    </body>
</html>
