<?php

Request::method('add',function(){
   load::php_file('admin/views/chat-bot/add');
});

Request::method('create',function(){
  global $con;
  $comp_username = post('comp_username');
  $comp_name = post('comp_name');
  $template_name = post('template_name');
  $compaign_date = post('compaign_date');
  $compaign_text = htmlentities(post('compaign_text'));
  
  $submit_btn = post('submit-btn');
  if(isset($submit_btn) and !empty($submit_btn)):
      
    $base_url = 'http://way2mint.seeksolution.in/miscall/miscall/web-app/chatbots';
    $encrypted_id = rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9);
    $short_url = '';
    
    // File Uploading Logic
        $campaign_image = $_FILES['compaign_image'];

        load::library('upload');
        if(isset($campaign_image['name']) and !empty($campaign_image['name'])){
            
                $file = new Upload();
            
                $file->set($campaign_image)
                  ->max_size(2000)
                  ->allow_extension('png|jpeg|jpg|PNG|JPEG|JPG')
                  ->directory(SYSTEM_PATH.'/resources/uploads/chatbots/images/');
            
            if($file->do_upload()){
            
            // print_r($file->file_info());
             
            //   prx(post(),false);
            //   prx($file->file_info());
              
              $filename = $file->file_info()['file_name'];
              $extension = $file->file_info()['type'];
              
              $image = 'resources/uploads/chatbots/images/'."{$filename}.{$extension}";
              
              
            }else{
              $error = $file->report();
              echo $error;
              
            }
            
            
    }//check if compain Image is set
    
    // File Uploading Logic
    
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    if($chatbot_model->addRecord(compact(['comp_username','comp_name','template_name','compaign_date','compaign_text','base_url','encrypted_id','short_url','image']))):
       return redirect_to('admin/chat-bot/show-record?msg=record-inserted');
        else:
            load::php_file('admin/views/chat-bot/add');
    endif;
    
    
        else:
      
  endif;
  
  
});

Request::method('show-record',function(){
    
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    $total_records = count($chatbot_model->getAllRecords());
    

    $pagination = new Pagination();

    $pagination->base_url(base_url('admin/chat-bot/show-record'));
    $records_per_page = 5;
    $limit = (($pagination->get_page() - 1) * $records_per_page);
    $chat_data = $chatbot_model->paginate($limit,$records_per_page);
    $pagination->records($total_records);
    $pagination->records_per_page($records_per_page);
    

    $pagination->set_query('navigation=active');
    $pagination->labels('Previous','Next');

    $data['chats_record'] = $chat_data;
    $data['pagination'] = $pagination;

    load::php_file('admin/views/chat-bot/show-record',$data);
});

Request::method('delete',function($id){
    
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
     if($chatbot_model->deleteRecordById($id)):
         
        return redirect_to('admin/chat-bot/show-record?msg=record-deleted');
     else:
         return redirect_to('admin/chat-bot/show-record?msg=cannot-delete');
         
     endif;
    
});

Request::method('update',function(){
    
  $data['error'] = '';
  $comp_username = post('comp_username');
  $comp_name     = post('comp_name');
  $template_name = post('template_name');
  $compaign_date = post('compaign_date');
  $compaign_text = htmlentities(post('compaign_text'));
  $chatbot_id    = post('id');
  
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
         $campaign_image = $_FILES['compaign_image'];

        load::library('upload');
        if(isset($campaign_image['name']) and !empty($campaign_image['name'])){
            
                $file = new Upload();
                $file->set($campaign_image)
                  ->max_size(2000)
                  ->allow_extension('png|jpeg|jpg|PNG|JPEG|JPG')
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
         load::php_file('admin/views/chat-bot/edit',$data);
     }else{
         
     }
     
    
});

Request::method('more',function($id){
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    $chat_data = $chatbot_model->getAllRecordsById($id);
    $data['chats_record'] = $chat_data;
    load::php_file('admin/views/chat-bot/more',$data);
});

Request::method('edit',function($id){
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    $chat_data = $chatbot_model->getAllRecordsById($id);
    $data['chats_record'] = $chat_data;
    
    load::php_file('admin/views/chat-bot/edit',$data);
});






