
<?php ob_start(); ?>
<?php switch (Request::get()) :
	
case 'user':
		
		$data['title']=isset($title)?$title:"";
		$data['bread_title']=isset($bread_title)?$bread_title:"";
		$data['bread_link']=isset($bread_link)?$bread_link:"";			
		load::view('layout/user/header',$data); 
		break;

case 'admin':
		
		$data['title']=isset($title)?$title:"";
		$data['bread_title']=isset($bread_title)?$bread_title:"";
		$data['bread_link']=isset($bread_link)?$bread_link:"";	
		load::view('layout/admin/header',$data); 
		break;

case 'api': 
	//
	break;
case 'whatsapp': 
	//
	break;

default:
		
		$data['title']=isset($title)?$title:"";
		$data['bread_title']=isset($bread_title)?$bread_title:"";	
		$data['bread_link']=isset($bread_link)?$bread_link:"";	
		load::view('layout/common/header',$data);
		break;
endswitch; ?>