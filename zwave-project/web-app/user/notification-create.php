<?php

if(method()=='POST'):

  $data['error'] = '';
    
  $comp_username = post('comp_username');
  $comp_name = post('comp_name');
  $template_name = post('template_name');
  $compaign_date = post('compaign_date');
  $compaign_text = htmlentities(post('compaign_text'));
  
  $submit_btn = post('submit-btn');
  if(isset($submit_btn) and !empty($submit_btn)):
    // Validation Code 
      $v = new Validator();
      $validator=$v->Intialize();

    $rules = $validator->make(post(),[
      'comp_username' => 'required',
      'comp_name' => 'required',
      'template_name' => 'required',
      'compaign_date' => 'required',
      'compaign_text' => 'required',
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
        // Validation Code 

        load::php_file('functions/user/settings');
        $url = setting_chatbot_url(2);
        $base_url = base_url($url);

        $encrypted_id = rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9);
        $short_url = '';

        //get the user ID from the session variable
        
        $session_data = Session::get('session_data');
        $user_id = $session_data['user_id'];

        //File Uploading Logic
        $campaign_image = isset($_FILES['compaign_image'])?$_FILES['compaign_image']:"";
        $image = NULL;

        load::library('upload');
            
        if(isset($campaign_image['name']) and !empty($campaign_image['name'])){
            
                $file = new Upload();

                load::php_file('functions/user/settings');
                $valid_size = setting_file_size(2); //get from the database
                $valid_size = (intval($valid_size));

                $valid_extension = setting_extensions(2); //get from the database

                $file->set($campaign_image)
                  ->max_size($valid_size)
                  ->allow_extension($valid_extension)
                  ->directory(SYSTEM_PATH.'/resources/uploads/chatbots/images/');
            
            if($file->do_upload()){
            
              
              $filename = $file->file_info()['file_name'];
              $extension = $file->file_info()['type'];
              
              if(isset($campaign_image) and !empty($campaign_image)){
                   $image = 'resources/uploads/chatbots/images/'."{$filename}.{$extension}"; 
              }
            
            }else{
                   $error['compaign_image'] = $file->report();
                   $data['error'] = $error;
            }
            
            
    }//check if compain Image is set

}//end of validation
       
    if(!empty($data['error'])){
        load::php_file('user/views/notification/add',$data);
    }else{
       load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    if($chatbot_model->addRecord(compact(['comp_username','comp_name','template_name','compaign_date','compaign_text','base_url','encrypted_id','short_url','image','user_id']))):

         return redirect_to('user/notification-manage?msg=record-inserted');
        else: 
          return redirect_to('user/notification-manage?msg=record-inserted-Error');
    endif;
   
    }
      
  endif; //Button has been Pressed or not
else: // Get Request for the Loading Views 
     load::php_file('user/views/notification/add');
endif;

