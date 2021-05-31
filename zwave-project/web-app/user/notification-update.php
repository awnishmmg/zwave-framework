<?php

if(method()=='POST'):
   
  $data['error'] = '';
  $comp_username = post('comp_username');
  $comp_name     = post('comp_name');
  $template_name = post('template_name');
  $compaign_date = post('compaign_date');
  $compaign_text = htmlentities(post('compaign_text'));
  $chatbot_id    = post('chatbot_id');
  
  $v = new Validator();
  $validator=$v->Intialize();
  
  $rules = $validator->make(post(),[
      'comp_username' => 'required',
      'comp_name'=>'required',
      'template_name'=> 'required',
      'compaign_text' => 'required',
      'compaign_date' => 'required',
   ]);
   
   $rules->setAliases([
	'comp_username' => 'Company Username',
	'comp_name' => 'Company Name',
    ]);
    
    $rules->validate();
    if($rules->fails()){
        $error = $rules->errors();
        $data['error'] = $error->firstofall();
    }else{
        
        //File Uploading Logic
         $campaign_image = isset($_FILES['compaign_image'])?$_FILES['compaign_image']:"";
        $image = NULL;

        load::library('upload');
        if(isset($campaign_image['name']) and !empty($campaign_image['name'])){
                

                $valid_size = setting_file_size(2); // get from database
                $valid_extension = setting_extensions(2); // get from database

                $file = new Upload();
                $file->set($campaign_image)
                    ->max_size($valid_size)
                    ->allow_extension($valid_extension)
                    ->directory(SYSTEM_PATH.'/resources/uploads/chatbots/images/');
            
            if($file->do_upload()){
                
              $filename = $file->file_info()['file_name'];
              $extension = $file->file_info()['type'];
              $image = 'resources/uploads/chatbots/images/'."{$filename}.{$extension}";
              
            }else{
                
               $error['compaign_image'] = $file->report();
               $data['error'] = $error;
              
            }
        //File Uploading Logic
        
        }
       
    }
     
     if(!empty($data['error'])){
         load::php_file('user/views/notification/edit',$data);
     }else{
         //code for the updating in the database
            load::php_file('functions/user/settings');
            $url = setting_chatbot_url(2);
            $base_url = base_url($url);
            // $base_url = base_url('chatbots');
    
         $encrypted_id = rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9);
        $short_url = '';
    
    
    //get the user ID from the session variable
    
        $session_data = Session::get('session_data');
        $user_id = $session_data['user_id'];
        
        load::model('admin/Chatbot');
        $chatbot_model = new  Chatbot_model();
        
        if($chatbot_model->updateRecord(compact(['comp_username','comp_name','template_name','compaign_date','compaign_text','base_url','encrypted_id','short_url','image','user_id']),$chatbot_id)):
            
            return redirect_to('user/notification-manage?msg=updated-sucessfully');
            
            else:
                 return redirect_to('user/notification-manage?msg=updated-Error');
           endif;
         
         //code for the updating in the database
         
     }
else:
    
endif;
