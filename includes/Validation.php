<?php
/**
 * Created by PhpStorm.
 * User: ready1
 * Date: 7/21/14
 * Time: 5:54 PM
 */

class Validation {
    public $emailExpression;
    public $anyExpression;

    public function __construct(){

        $this->emailExpression = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $this->anyExpression = '/^[A-Za-z0-9-]*$/';

    }

    public function validate_email($email){

        //check for valid email
        if(empty($email)){
            return false;
        }else{
            //remove any tags
            $cleanemail = strip_tags($email);

            if(preg_match($this->emailExpression,$cleanemail)){
                return true;
            }else{
                return false;
            }

        }

    }

    public function validate_all($text){

        //check for valid email
        if(empty($text)){
            return false;
        }else{
            //remove any tags
            $cleanetext = strip_tags($text);

            if(preg_match($this->anyExpression,$cleanetext)){

                return true;

            }else{

                return false;
            }

        }

    }


} 