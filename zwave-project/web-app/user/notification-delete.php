<?php

if(method()=='GET'):
    
    load::model('admin/Chatbot');
    
    $chatbot_model = new  Chatbot_model();
    
     if($chatbot_model->deleteRecordById(get('id'))):
         
        return redirect_to('user/notification-manage?msg=record-deleted');
     else:
         return redirect_to('user/notification-manage?msg=cannot-delete');
         
     endif;
    
endif;