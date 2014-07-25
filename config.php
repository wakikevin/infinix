<?php
	if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){
		define('DBPREFIX','infinix_');
		define("BASE_URL", "http://127.0.0.1/infinix");
		define("TWITTER_URL", "http://squadlab.com/infinix");
		define("TWITTER_TEXT", "I’ve just helped bring down the price of the new Infinix Zero smartphone. The more shares the lower the price.");
		define("FACEBOOK_URL", "http://squadlab.com/infinix");
		define("FACEBOOK_CAPTION", "The Infinix Zero is here ");
		define("FACEBOOK_DESC", "I’ve just helped bring down the price of the new Infinix Zero smartphone. The more shares the lower the price.Pre-order yours today!");
		define("FACEBOOK_PICTURE", BASE_URL."/img/facebook-pic.png");
		
		define("SHARE_COUNT", 60000);
		define("SHARE_VALUE", 5);
		define('CONSUMER_KEY', 'sNzQAsr4CUUQC310y7ingMhmB');
		define('CONSUMER_SECRET', 'ihRywuweUMbK5GLpxS0kEk6JG8znXGqicVxC9LhlvqbFJWutle');
		define('OAUTH_CALLBACK', 'http://localhost/infinix/callback.php');
	
		define('DATABASE_SERVER','localhost');
		define('DATABASE_USER','root');
		define('DATABASE_PASSWORD','');
		define('DATABASE_NAME','infinix');
		
		define('CONNECTION_STRING', 'mysql:host=localhost;dbname=infinix');
	}else{
		define('DBPREFIX','infinix_');
		define("BASE_URL", "http://squadlab.com/infinix");
		define("TWITTER_URL", "http://squadlab.com/infinix");
		define("TWITTER_TEXT", "I’ve just helped bring down the price of the new Infinix Zero smartphone. The more shares the lower the price. ");
		define("FACEBOOK_URL", "http://squadlab.com/infinix");
		define("FACEBOOK_CAPTION", "The Infinix Zero is here ");
		define("FACEBOOK_DESC", "I’ve just helped bring down the price of the new Infinix Zero smartphone. The more shares the lower the price.Pre-order yours today!");
		define("FACEBOOK_PICTURE", BASE_URL."/img/facebook-pic.png");
		define("SHARE_COUNT", 60000);
		define("SHARE_VALUE", 5);
		define('CONSUMER_KEY', 'sNzQAsr4CUUQC310y7ingMhmB');
		define('CONSUMER_SECRET', 'ihRywuweUMbK5GLpxS0kEk6JG8znXGqicVxC9LhlvqbFJWutle');
		define('OAUTH_CALLBACK', 'http://squadlab.com/infinix/callback.php');
		
		define('DATABASE_SERVER','equityinsurance.db.9126389.hostedresource.com');
		define('DATABASE_USER','equityinsurance');
		define('DATABASE_PASSWORD','DI9C4Ge7c3@');
		define('DATABASE_NAME','equityinsurance');
		define('CONNECTION_STRING', 'mysql:host=equityinsurance.db.9126389.hostedresource.com;dbname=equityinsurance');
	}
	
	if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){
		define('EMAIL_SERVER','smtp.gmail.com');
		define('EMAIL_SERVER_PORT','587');
		define('SMTP_USER_ACCOUNT','dev.gsoft@gmail.com');
		define('SMTP_USER_PASSWORD','qualityseal2');
		define('EMAIL_SEND_DEBUG_MODE','0');
		define('SMTP_AUTH', true);
		
		define('EMAIL_FROM_ADDRESS', 'kevin.kyalo@squaddigital.com');
		define('EMAIL_FROM_NAME', 'Infinix ZERO');
		define('EMAIL_REPLY_TO_ADDRESS', 'kevin.kyalo@squaddigital.com');
		define('EMAIL_REPLY_TO_NAME', 'Infinix ZERO');
		define('EMAIL_SUBJECT', 'Infinix ZERO Pre - Order');
		define('EMAIL_ALTERNATE_BODY_MESSAGE', 'If you are aunable to see this email, contact the administrator.');
	}else{
		define('EMAIL_SERVER','localhost');		
		define('EMAIL_FROM_ADDRESS', 'kevin.kyalo@squaddigital.com');
		define('EMAIL_FROM_NAME', 'Infinix ZERO');
		define('EMAIL_REPLY_TO_ADDRESS', 'kevin.kyalo@squaddigital.com');
		define('EMAIL_REPLY_TO_NAME', 'Infinix ZERO');
		define('EMAIL_SUBJECT', 'Infinix ZERO Pre - Order');
		define('EMAIL_ALTERNATE_BODY_MESSAGE', 'If you are aunable to see this email, contact the administrator.');
	}