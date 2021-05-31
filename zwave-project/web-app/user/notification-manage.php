<?php

if(method()=='GET'):
    
    $session_data = Session::get('session_data');
    $user_id = $session_data['user_id'];
    
    load::model('admin/Chatbot');
    $chatbot_model = new  Chatbot_model();
    
    // $total_records = count($chatbot_model->getAllRecords());
    
    $total_records = count($chatbot_model->getAllRecordsByUserId($user_id));
    
    //get the user ID from the session variable
    
    $pagination = new Pagination();

    $pagination->base_url(base_url('user/notification-manage'));
    
    $records = get('records');
    $records_per_page = isset($records)?$records:5;
    $limit = (($pagination->get_page() - 1) * $records_per_page);
    
    // $chat_data = $chatbot_model->paginate($limit,$records_per_page);
    
    $chat_data = $chatbot_model->paginateByUserId($limit,$records_per_page,$user_id);
    
    $pagination->records($total_records);
    $pagination->records_per_page($records_per_page);

    $pagination->set_query('navigation=active');

    $data['chats_record'] = $chat_data;
    $data['pagination'] = $pagination;

    load::php_file('user/views/notification/show',$data);
    
endif;


