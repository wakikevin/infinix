<?php

//include required files
include('config.php');
include('includes/ORM.class.php');


//generate and save verification code
//$code = strtoupper(md5(time()));
$codeNum = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
$randNumber = rand(10, 99);
$code = strtoupper($codeNum.'-'.$randNumber);

//database connection
ORM::configure(array(
    'connection_string' => CONNECTION_STRING,
    'username' => DATABASE_USER,
    'password' => DATABASE_PASSWORD,
    'logging' => true
));

//1. fields to be inserted
$codeQuery = array('code'=>$code);
//2. set on class to save
ORM::for_table(DBPREFIX.'codeverify')->create($codeQuery)->save();

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
        <script src="js/vendor/jquery-1.9.1.min.js"></script>
        <script src="js/vendor/modernizr-2.7.1.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/js/code_library.js"></script>
        <script src="<?php echo BASE_URL; ?>/js/default.js"></script>
        <script src="<?php echo BASE_URL; ?>/js/preorder.js"></script>
    </head>
    <body class="loading">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

         <div class="nav-container">
		    <div class="mobile-menu">
		        <ul>
		          <li><a href="index.php">MEET INFINIX ZERO</a></li>
		          <li><a href="pre-order.php" class="current">PRE-ORDER</a></li>
		          <li><a href="share.php">SHARE</a></li>
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
							<li><a href="index.php">MEET INFINIX ZERO</a></li>
							<li><a href="pre-order.php" class="current">PRE-ORDER</a></li>
							<li><a href="share.php">SHARE</a></li>
						</ul>
						<br style="clear:left"/>
   					</div>
					
				</div>

       		</div>
       	</div>
       	 
       	 
       	
       	<main>
       	 
	        <div id="pre-order">

	        	<div class="content-main">
	        		<div class="page-bg"></div>
	                <div class="wrap">
	                  <div class="top-section">
	                    <div class="left-section">
	                        <div class="vertical-align">
	                          <img src="img/pre-order-phone.png" alt="" class="preoader-img">
	                        </div>
	                      </div>
	                      <div class="right-section">
	                        <div class="vertical-align">
	                          <div class="form-container">
	                            <div id="notify" class="notify form-error" style="display:none;">Please enter a valid name</div>
	                            <div class="notify loadin" style="display:none;">Sending...</div>
	                            <div class="success" style="display:none;">Thank you for your Pre-order. <br/>We will inform you once the phone is ready.<br /> <br/> Continue sharing to lower the price.</div>
	                            <form id="frm-pre-order" action="" style="display:block;">
	                            	<div class="left-colgroup">
	                            		<label for="">Name</label>
	                            		<input type="text" id="name" name="name" />
	                            		<label for="">Telephone</label>
	                              		<input type="text" id="telephone" name="telephone" />
	                              		<label for="">Email Address</label>
	                             		<input type="text" name="email" id="email" />
	                             		<label for="">Select Colour</label>
	                             		<div class="selectdiv">  
								          <select class="selectboxdiv" id="color" name="color">
								            <option value="Black" selected="selected">Black</option>
								            <option value="White">White</option>
								            <option value="Gold">Gold</option>
								          </select>
								          <div class="out">Black</div>
									    </div>
									    <label for="">Memory size</label>
	                              		<div class="selectdiv" >
								          <select class="selectboxdiv" name="memory" id="memory">
								            <option value="8GB" selected="selected">8GB</option>
								            <option value="16GB">16GB</option>
								          </select>
								          <div class="out">8G+1G RAM+ROM</div>
									    </div>
									
	                            	</div>
	                              	<div class="right-colgroup">
	                              		
	                            		<label for="">City</label>
	                            		<div class="selectdiv">  
								          <select class="selectboxdiv" name="city" id="city">
								            <option value="Abuja" selected="selected">Abuja</option>
								            <option value="Lagos">Lagos</option>
								            <option value="Port Harcourt">Port Harcourt </option>
								          </select>
								          <div class="out">Abuja</div>
									    </div>
	                              		<label for="">Postal Address</label>
	                             		<textarea name="postal" id="postal" cols="30" rows="10" ></textarea>
	                             		<label for=""> Security Check</label>
									    <div class="security-box">
									    	<div class="short-math" id="short-math">8 + 4 =</div>
									    	<input type="text" id="robot" name="robot" />
									    </div>
										<label for="powerbank"><input type="checkbox" name="powerbank" value="yes" />&nbsp; Include a Power Bank now <br/><b>@ N 1,500</b> instead of <b>N4,000</b></label>
	                              		<input type="button" id="btnPreoder" value="Pre-order" />
	                              	</div>
	                                <input id="code" name="code" value="<?php echo $code; ?>" type="hidden" />
                                    <input id="robotTotal" name="robotTotal" value="" type="hidden" />
                                    <input id="task" name="task" value="preorder" type="hidden" />
	                            </form>
	                          </div>
	                        </div>
	                      </div>
	                  </div>
	                  <div class="preorder-notice">
	                    <div class="notice">
	                      Only you and your friends can help lower the price of this amazing phone. Keep sharing our promo with your friends on Facebook and Twitter today and watch the price drop!
	                    </div>
	                  </div>
	                </div>
               </div>
	        	 
		    </div>
		    
		  
		    
		</main>

		</div>

        <script src="js/imagesloaded.js"></script>
        <script src="js/skrollr.js"></script>
        <script src="js/_main.js"></script>
         <script src="js/allscript.js"></script>

    </body>
</html>
