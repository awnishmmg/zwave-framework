<?php


// Require the Files 
require_once __DIR__.'/vendor/autoload.php';

/**
*
* All the Namespace will be Added here 
* Default Namespace : Rankit\Validation\Validator
*/

use Rakit\Validation\Validator as Validators;

class Validator{
    
    public function Intialize(){
        
        $validator = new Validators();
        return $validator;
    }

    public function init(){
        
        $validator = new Validators();
        return $validator;
    }
}


// Validation File Global Functions 
function set_error($keyname='',$errors_variable=[]){
    if(is_array($errors_variable) && array_key_exists($keyname,$errors_variable)){
        $error=$errors_variable[$keyname];
        if(isset($error)){
            return $error;
        }else{
            return "";
        }
    }
}



// Validation File Global Functions for setting value
function set_value($keyname='',$post=[],$default_key=''){
   if(array_key_exists($keyname,$post)):
       return isset($post[$keyname])?$post[$keyname]:"";
   else:
       return isset($post[$default_key])?$post[$default_key]:"";
   endif;
   
   
    
}

//Enable Js Validation 
function set_js_error($error=[]){
   
   if(is_array($error) and count(@$error)>0){
               $script = "";
            
            foreach(@$error as $key => $value){
                
                $script  = "<script>";
                $script .= "var element = document.getElementById('$key');";
                $script .= 'element.style="border:4px solid red;";';
                $script .= "</script>";
                echo $script;
            }
   } 
    
    
}









