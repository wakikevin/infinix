<?php
	define("BASE_URL", "http://localhost/infinix");
	
	if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){
		define('DATABASE_SERVER','localhost');
		define('DATABASE_USER','root');
		define('DATABASE_PASSWORD','');
		define('DATABASE_NAME','infinix');
		define('CONNECTION_STRING', 'mysql:host=localhost;dbname=infinix');
	}else{
		define('DATABASE_SERVER','');
		define('DATABASE_USER','');
		define('DATABASE_PASSWORD','');
		define('DATABASE_NAME','');
		define('CONNECTION_STRING', '');
	}
	
	if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){
		define('EMAIL_SERVER','smtp.gmail.com');
		define('EMAIL_SERVER_PORT','587');
		define('SMTP_USER_ACCOUNT','dev.gsoft@gmail.com');
		define('SMTP_USER_PASSWORD','qualityseal2');
		define('EMAIL_SEND_DEBUG_MODE','0');
		define('SMTP_AUTH', true);
		
		define('EMAIL_FROM_ADDRESS', 'kevin.kyalo@squaddigital.com');
		define('EMAIL_FROM_NAME', 'Tecno Mobile');
		define('EMAIL_REPLY_TO_ADDRESS', 'kevin.kyalo@squaddigital.com');
		define('EMAIL_REPLY_TO_NAME', 'Tecno Mobile');
		define('EMAIL_SUBJECT', 'Infinix Pre - Order');
		define('EMAIL_ALTERNATE_BODY_MESSAGE', 'If you are aunable to see this email, contact the administrator.');
	}else{
		define('EMAIL_SERVER','localhost');
		define('EMAIL_SERVER_PORT','587');
		define('SMTP_USER_ACCOUNT','');
		define('SMTP_USER_PASSWORD','');
		define('EMAIL_SEND_DEBUG_MODE','0');
		define('SMTP_AUTH', false);
		
		define('EMAIL_FROM_ADDRESS', '');
		define('EMAIL_FROM_NAME', '');
		define('EMAIL_REPLY_TO_ADDRESS', '');
		define('EMAIL_REPLY_TO_NAME', '');
		define('EMAIL_SUBJECT', '');
		define('EMAIL_ALTERNATE_BODY_MESSAGE', 'If you are aunable to see this email, contact the administrator.');
	}