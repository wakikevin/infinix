<?php
	session_start();
	
	require "config.php";
	require "includes/ORM.class.php";
    require "includes/validation.php";
	require "phpmailer/class.phpmailer.php";
	
	
	$task = isset($_POST['task']) ? $_POST['task'] : "";
   $error = array();

	
	switch($task){

        case"preorder":

            $status = verifyCode();
            if($status){
                preOrder();
            }else{
                $error['code'] = '001';
                $error['desc'] = 'The security token is invalid. Please try again Later.';
                echo json_encode($error);
            }

        break;
        case "fbinit":

            shareCount();

            break;
        case "fbuser":

        saveFbUser();

        break;
        case "fbshare":

            shareFB();

        break;
        case "twitterShare":

            twitterShare();

        break;

	}

    function initialize(){

        //get database object
        ORM::configure(array(
            'connection_string' => CONNECTION_STRING,
            'username' => DATABASE_USER,
            'password' => DATABASE_PASSWORD,
            'logging' => true
        ));

    }

    function verifyCode(){
        //database object
        initialize();

        $code = isset($_POST['code']) ? $_POST['code'] : '';

        //get code in database for comparison
        $code = ORM::for_table(DBPREFIX.'codeverify')->where_like('code',$code)->find_one();

        if(isset($code->isused) && $code->isused == '0'){
            //echo $code->id;
            //remove code
            ORM::for_table(DBPREFIX.'codeverify')->where_like('id',$code->id)->delete_many();

            return true;
        }else{
            return false;
        }



    }
	
	function preOrder(){

        //initialize db
        initialize();

		//get posted data
		  $name = isset($_POST['name']) ? $_POST['name'] : "";
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $color = isset($_POST['color']) ? $_POST['color'] : "";
        $memory = isset($_POST['memory']) ? $_POST['memory'] : "";
        $city = isset($_POST['city']) ? $_POST['city'] : "";
        $postal = isset($_POST['postal']) ? $_POST['postal'] : "";
		$ordernumber = isset($_POST['code']) ? $_POST['code'] : "";
		$powerbank = isset($_POST['powerbank']) ? $_POST['powerbank'] : "";  
        //get validation class
        $validate = new Validation();
        $error = array();

        
            if($validate->validate_all($telephone)){
                if($validate->validate_email($email)){
                    if($validate->validate_all($color)){
                        
                            if($validate->validate_all($city)){
                               

                                    //save the data in the database
                                    $orderQuery = array('name'=>$name,'telephone'=>$telephone,
                                                        'email'=>$email,'color'=>$color,'memory'=>$memory,
                                                        'city'=>$city,'postal'=>$postal,'ordernumber'=>$ordernumber,'powerbank'=>$powerbank);

                                    $saved = ORM::for_table(DBPREFIX.'orders')->create($orderQuery)->save();

                                    if($saved){
										
										//send email
										/*define('EMAIL_FROM_ADDRESS_INNER', $email);
										define('EMAIL_FROM_NAME_INNER', $name);
										define('EMAIL_REPLY_TO_ADDRESS_INNER', $email);
										define('EMAIL_REPLY_TO_NAME_INNER', $name);*/

										$htmllink = BASE_URL.'/edm/index.html';
										$message = file_get_contents($htmllink);
										$message = str_replace("{name}", $name, $message);
										$message = str_replace("{imagebase}", BASE_URL, $message);
										/*$message = str_replace("{phone}", $telephone, $message);
										$message = str_replace("{city}", $city, $message);
										$message = str_replace("{color}", $color, $message);
										$message = str_replace("{memory}", $memory, $message);*/
										$message = str_replace("{ordernumber}", $ordernumber, $message);
										//echo $ordernumber;

										$message = str_replace(chr(194),"", $message);

										if(sendEmail($email,$name,EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME, $message)){

												$error['code'] = '000';
												$error['desc'] = 'Your pre-order was successful. <br/>Lower the price of the Infinix Zero by sharing our promo with your friends<div class="pre-orderbtn"><a href="share.php" class="pre-order-btn">SHARE NOW</a></div>';
										
										}else{
											$error['code'] = '009';
											$error['desc'] = 'Your pre-order was not successful. Please try again after 15 min or Contact site administrator.';

										}

									}else{
										$error['code'] = '010';
										$error['desc'] = 'Your Order was not successful<b>NOTE: You can only Pre-order Once </b>. Please try again after 15 min or Contact site administrator.';
									}
									


                 
                            }else{
                                $error['code'] = '007';
                                $error['desc'] = 'Please enter a valid city';
                            
                        }
                    }else{
                        $error['code'] = '005';
                        $error['desc'] = 'Please enter a valid color';
                    }
                }else{
                    $error['code'] = '004';
                    $error['desc'] = 'Please enter a valid email';
                }
            }else{
                $error['code'] = '003';
                $error['desc'] = 'Please enter a valid telephone';
            }

        

       echo json_encode($error);
	}

    function saveFbUser(){
        //initialize db
        initialize();

        //get user id
        $userid = isset($_POST['uid']) ? $_POST['uid'] : '';

        //check if user exists
        $user = ORM::for_table(DBPREFIX.'shares')->where_like('fb_id',$userid)->find_one();

        if(!isset($user->fb_id)){

            $userQuery = array('fb_id'=>$userid,'shareCount'=>'100');
            $saved = ORM::for_table(DBPREFIX.'shares')->create($userQuery)->save();
            if($saved){
                echo '1';
            }else{
                echo '0';
            }

        }else{
            echo '1';
        }


       // echo $userid;
    }

function shareFB(){
    //initialize db
    initialize();

    //get user id
    $userid = isset($_POST['uid']) ? $_POST['uid'] : '';

    //check if user exists
    $user = ORM::for_table(DBPREFIX.'shares')->where_like('fb_id',$userid)->find_one();
    $error = array();
    if(!isset($user->fb_id)){

        $error['code'] = '001';
        $error['desc'] = 'Could not find user';


    }else{

        $newCount = intval($user->shareCount) + 1;
        // reduce count
        $user->shareCount = $newCount ;

        // Syncronise the object with the database
        $user->save();

		$price = ORM::for_table(DBPREFIX.'price')->find_one();
		$newShareCount = intval($price->shareCount) + 1;
		$newShareValue = intval($price->shareValue) + SHARE_VALUE;
		
		$price->shareCount = $newShareCount;
		$price->shareValue = $newShareValue;
		
		$newPrice = intval($price->zero_price) - intval($newShareValue);
		
		$price->save();

        $error['code'] = '000';
        $error['desc'] = number_format($newPrice);

    }
    echo json_encode($error);
       // echo $userid;
}

function twitterShare(){
    //initialize db
    initialize();

    //get user id
    $userid = isset($_SESSION['twitter_id']) ? $_SESSION['twitter_id'] : '';

    //check if user exists
    $user = ORM::for_table(DBPREFIX.'twittershare')->where_like('twitter_id',$userid)->find_one();
    $error = array();
    if(!isset($user->twitter_id)){

        $error['code'] = '001';
        $error['desc'] = 'Could not find user';


    }else{

        $newCount = intval($user->shareCount) + 1;
        // reduce count
        $user->shareCount = $newCount ;

        // Syncronise the object with the database
        $user->save();
		
		$price = ORM::for_table(DBPREFIX.'price')->find_one();
		$newShareCount = intval($price->shareCount) + 1;
		$newShareValue = intval($price->shareValue) + SHARE_VALUE;
		
		$price->shareCount = $newShareCount;
		$price->shareValue = $newShareValue;
		
		$newPrice = intval($price->zero_price) - intval($newShareValue);
		
		$price->save();

        $error['code'] = '000';
        $error['desc'] = number_format($newPrice);

    }
    echo json_encode($error);
       // echo $userid;
}
function shareCount(){

    //initialize db
    initialize();

    //check if user exists
    $price = ORM::for_table(DBPREFIX.'price')->find_one();
	
    $error = array();
    if(!isset($price->zero_price)){

        $error['code'] = '001';
        $error['desc'] = 'Could not set price';


    }else{

        $newPrice = intval($price->zero_price) - intval($price->shareValue);

        $error['code'] = '000';
		
        $error['desc'] = number_format($newPrice);

    }
    echo json_encode($error);
    // echo $userid;
}

    //fiunction to send email
	function sendEmail($sendToAddress, $sendToName,$corporateEmail,$corporateName,$message){
		try{
			$smtp_account = SMTP_USER_ACCOUNT;
			$mailSender = new PHPMailer();
			
			if(defined(SMTP_USER_ACCOUNT)){
				$mailSender->IsSMTP();
				$mailSender->Host = EMAIL_SERVER;
				$mailSender->SMTPAuth = SMTP_AUTH;
				$mailSender->SMTPSecure = "tls";
				$mailSender->SMTPDebug = 0;
				$mailSender->Port = EMAIL_SERVER_PORT;
				$mailSender->IsHTML(true);
				$mailSender->Username = SMTP_USER_ACCOUNT;
				$mailSender->Password = SMTP_USER_PASSWORD;
				$mailSender->SetFrom(EMAIL_FROM_ADDRESS_INNER, EMAIL_FROM_NAME_INNER);
				$mailSender->AddReplyTo(defined('EMAIL_REPLY_TO_ADDRESS_INNER') ? EMAIL_REPLY_TO_ADDRESS_INNER : "", defined('EMAIL_REPLY_TO_NAME_INNER') ? EMAIL_REPLY_TO_NAME_INNER : "");
				$mailSender->Subject = defined('EMAIL_SUBJECT') ? EMAIL_SUBJECT : 'Be part of the Equity League of Champions winning Team';
				$mailSender->AltBody = EMAIL_ALTERNATE_BODY_MESSAGE;
				$mailSender->MsgHTML($message);
				$mailSender->AddAddress($sendToAddress, $sendToName);
				$mailSender->AddAddress($corporateEmail,$corporateName);
			}else{
				$mailSender->Host = EMAIL_SERVER;
				$mailSender->SMTPDebug = 0;
				$mailSender->Port = 25;
				$mailSender->IsHTML(true);
				$mailSender->SetFrom(EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME);
				$mailSender->AddReplyTo(defined('EMAIL_REPLY_TO_ADDRESS') ? EMAIL_REPLY_TO_ADDRESS : "", defined('EMAIL_REPLY_TO_NAME') ? EMAIL_REPLY_TO_NAME : "");
				$mailSender->Subject = defined('EMAIL_SUBJECT') ? EMAIL_SUBJECT : 'Infinix ZERO Pre-Order';
				$mailSender->AltBody = EMAIL_ALTERNATE_BODY_MESSAGE;
				$mailSender->MsgHTML($message);
				$mailSender->AddAddress($sendToAddress, $sendToName);
			}
			
			if(!$mailSender->Send()){
				return false;
			} else {
				return true;
			}
		}catch (Exception $ex){
			return false;
		}
	}
?>