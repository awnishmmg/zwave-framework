<?php

#Sms Api Form Integration.
Request::method('sms-api',function(){
   load::php_file('admin/views/integration/sms-api');
   
});

#Show Api Integrations
Request::method('show-api',function(){
   load::model('admin/Sms_api');
   $sms_api_model = new Sms_api_model();
   $sms_data=$sms_api_model->getAllSmsApi();
   $data['sms_data'] = $sms_data;
   load::php_file('admin/views/integration/show-api',$data);
   
});

#Create the Api Integrations
Request::method('create',function(){
    
    if(method()=='POST'):
         $submit_btn = sanitise(post('submit-btn'));
        if(isset($submit_btn) && !empty($submit_btn)):
            
                        $api_name = sanitise(post('api_name'));
                        $base_url = sanitise(post('base_url'));
                        $api_params = sanitise(post('api_params'));
                        $activation_status = sanitise(post('activation_status'));
                        
                           load::model('admin/Sms_api');
                           
                           $sms_api_model = new Sms_api_model();
                           
                           if($sms_api_model->addSendApi(compact('api_name','base_url','api_params','activation_status'))):
                                    set_flash('msg','message',[
                                       'message' => alert_success(" {$GLOBALS['success']} Api Integration Added Successfully. "), 
                                    ]);
                            else:
                                  set_flash('msg','message',[
                                       'message' => alert_danger(" {$GLOBALS['success']} Api Integration Added Successfully. "), 
                                    ]);
                            endif;
                        
        else:
            
        endif;
        
    endif;
    
    load::php_file('admin/views/integration/sms-api');
    
   
});