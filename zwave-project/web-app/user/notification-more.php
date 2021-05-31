<?php

if(method()=='GET'):
    
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    $chat_data = $chatbot_model->getAllRecordsById(get('id'));
    $data['chats_record'] = $chat_data;
    
    load::php_file('user/views/notification/more',$data);

endif;
