<?php
load::php_file('package/xls-to-csv');

use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use \PhpOffice\PhpSpreadsheet\Writer\Csv;
use \PhpOffice\PhpSpreadsheet\Reader\IReadFilter;


/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $worksheetName = '') {
        //  Read rows 1 to 7 and columns A to E only
            if (in_array($column,range('D','F'))) {
                  return true;
            }

        return false;
    }
}


Request::method('xls-converter',function(){
load::model('user/User');
class_alias('User_model','User');
$user = new User();
$companies=$user->getCompany();
$contacts = $user->getContactsPersons();


load::model('admin/Xls_converter');
class_alias('Xls_converter_model','Xls_converter');
$xls = new Xls_converter();
$uploads=$xls->getAllUploads();

load::model('admin/Download');
class_alias('Download_model','Downloads');
$download = new Downloads();
$downloads = $download->getDownloads();

$data['companies'] = $companies??[];
$data['contacts'] = $contacts??[];
$data['uploads'] = $uploads??[];
$data['downloads'] = $downloads??[];

load::php_file('admin/views/xls-converter/app',$data);

});


Request::method('xls-upload',function(){
	$data = array();

	$conversion_type = sanitise(post('conversion_type'));
	$company_name = sanitise(post('company'));
	$contact_person = sanitise(post('contact'));

	// $uploaded_files = $_FILES['uploaded_files']??NULL;

	$v = new Validator();
	$validator = $v->init();

	$rules = $validator->make(post(),[
		'conversion_type'=>'required',
		'company'=>'required',
		'contact'=>'required',
	]);

	$rules->validate();
	if($rules->fails()){
		$error = $rules->errors();
		$data['error'] = $error->firstOfall();
	}

$uploaded_files = file_object('uploaded_files');
load::library('upload');
load::model('admin/Xls_converter');
class_alias('Xls_converter_model','Xls_converter');

//Logic for Conversion Type
if($conversion_type=='zip_to_csv'):

$upload_dir = SYSTEM_PATH.'/resources/uploads/';
$upload = new Upload();
$upload->set($uploaded_files)
  ->max_size(100)
  ->allow_extension('zip')
  ->directory($upload_dir);

$tmpName = $uploaded_files['tmp_name'];

$fileinfo = pathinfo($uploaded_files['name']);
$extension = $fileinfo['extension'];
$filename = $fileinfo['filename'];

$random = rand(1111111111111111,9999999999999999);
$extracted_path = SYSTEM_PATH.'/resources/uploads/tools/'.$random;
if(!mkdir($extracted_path)){
	exit('* Cannot Make Directory');
}

if($extension=='zip'){
		$zip = new ZipArchive();
		if($zip->Open($tmpName)===TRUE){
		$zip->extractTo($extracted_path);
		$zip->close();
		}else{
			echo 'Something Went Wrong';
			exit;
		}
}

if($upload->do_upload()){
	$archived_data = json_encode($upload->file_info());
}

$details = scandir("{$extracted_path}/{$filename}");
unset($details[0],$details[1]);
$uploaded_path = json_encode([array("files"=>array_values($details),"count"=>count($details),"folder_name"=>$filename)]);
$is_processed=0;
$is_uploaded=1;
$is_deleted=0;
$root_path= 'resources/uploads/tools/'.$random;
$assets_path='';
$uploads = $uploaded_path;
$archived=$archived_data;
$date=date('Y-m-d');
$uploaded_at = date('H:i:s');
$processed_at = '';
$deleted_at = '';

$xls_converter = new Xls_converter();
if($xls_converter->create(compact(['conversion_type','company_name','contact_person','is_processed','is_uploaded','is_deleted','root_path','assets_path','uploads','archived','date','uploaded_at','processed_at','deleted_at']))){
set_flashdata('message','Zip Files Uploaded Successfully','success');
return redirect_to('admin/tools/xls-converter');
}else{
set_flashdata('message','Zip Files Cannot be Uploaded','danger');
return redirect_to('admin/tools/xls-converter');
}


elseif($conversion_type=='xls_to_csv'):
	// Code of Conversion of Uploading Xls and Processing
$random = rand(1111111111111111,9999999999999999);
$upload_dir = SYSTEM_PATH.'/resources/uploads/tools/'.$random;
if(!mkdir($upload_dir)){
	exit('* Cannot Make Directory');
}

for($i=0; $i<count($uploaded_files['name']); $i++){

$files['name'] = $uploaded_files['name'][$i];
$files['type'] = $uploaded_files['type'][$i];
$files['size'] = $uploaded_files['size'][$i];
$files['tmp_name'] = $uploaded_files['tmp_name'][$i];

$upload = new Upload();
$upload->set($files)
  ->max_size(500)
  ->allow_extension('xls|xlsx|csv')
  ->name($files['name'])
  ->directory($upload_dir);

if($upload->do_upload()){
	$details[] = $upload->file_info();
}

}


$uploaded_path = json_encode($details);
$is_processed=0;
$is_uploaded=1;
$is_deleted=0;
$root_path= 'resources/uploads/tools/'.$random;
$assets_path='';
$uploads = $uploaded_path;
$archived='';
$date=date('Y-m-d');
$uploaded_at = date('H:i:s');
$processed_at = '';
$deleted_at = '';


$xls_converter = new Xls_converter();
if($xls_converter->create(compact(['conversion_type','company_name','contact_person','is_processed','is_uploaded','is_deleted','root_path','assets_path','uploads','archived','date','uploaded_at','processed_at','deleted_at']))){
set_flashdata('message','Files Uploaded Successfully','success');
return redirect_to('admin/tools/xls-converter');
}else{
set_flashdata('message','Files Cannot be Uploaded','danger');
return redirect_to('admin/tools/xls-converter');
}

endif;

});

Request::method('xls-process',function($id){
	$uploads = array();

	//Get the Root Folder Name from the database
	load::model('admin/Xls_converter');
	class_alias('Xls_converter_model','Xls_converter');
    $xls_converter = new Xls_converter();
    $uploads = $xls_converter->getUploadsById($id);
	$path = SYSTEM_PATH.'/'.$uploads['root_path'];

	if($uploads['conversion_type']=='zip_to_csv'){

		$folder_name = json_decode($uploads['uploads'],true)[0]['folder_name'];
		$excel_files = json_decode($uploads['uploads'],true)[0]['files'];
		$path = $path.'/'.$folder_name;

	}elseif($uploads['conversion_type']=='xls_to_csv'){
			//Scan the Root Directory where files have been uploaded
			$excel_files=scandir($path);
			unset($excel_files[0],$excel_files[1]);
	}

	$random = rand(1111111111111111,9999999999999999);
	$csv_dir = SYSTEM_PATH.'/resources/support-tools/excel-csv/'.$random;
	if(!mkdir($csv_dir)){
		exit('* Cannot Make Directory');
	}
	
foreach($excel_files as $index => $excels):
$excel_file = pathinfo($excels,PATHINFO_FILENAME);
$xls_file = $path."/{$excels}";
$reader = new Xlsx();
$spreadsheet = $reader->load($xls_file);
$loadedSheetNames = $spreadsheet->getSheetNames();
$writer = new Csv($spreadsheet);
foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    $writer->setSheetIndex($sheetIndex);
    $writer->save($csv_dir.'/'.$excel_file.'.csv');
}

endforeach;	

$assets_path = 'resources/support-tools/excel-csv/'.$random;
if($xls_converter->updateOnly(['assets_path'=>$assets_path,'is_processed'=>1],$id)){
	set_flashdata('message','Files Processed Successfully','success');
		return redirect_to('admin/tools/xls-converter');
}else{
	set_flashdata('message','Files Cannot be Processed','danger');
		return redirect_to('admin/tools/xls-converter');
}

});

Request::method('xls-manage',function($action,$id){
	load::model('admin/Xls_converter');
	class_alias('Xls_converter_model','Xls_converter');
    $xls_converter = new Xls_converter();

	switch($action):

	case 'edit':
		
	break;

	case 'delete':
	
	break;

	case 'archive':
			//Get the Root Folder Name from the database
	load::model('admin/Download');
	class_alias('Download_model','Downloads');

	$download = new Downloads();

    $uploads = $xls_converter->getUploadsById($id);
	$path = SYSTEM_PATH.'/'.$uploads['assets_path'];
	load::library('zip');
	$zip = new ZipArchiver();
	$downloads = 'resources/downloads/output_'.time().'.zip';
	$output = SYSTEM_PATH.'/'.$downloads;
	if($zip->zipDir($path,$output)){
		if($download->create([$id,'Processed Archive',$downloads,date('Y-m-d'),date('H:i:s'),0])){
			set_flashdata('message','Processed Archive Was Recently Downloaded','success');
			return redirect_to($downloads);
		}else{
			set_flashdata('message','Zip Not Archived','danger');
			return redirect_to('admin/tools/xls-converter');
		}

	}else{
		
	}
	
	break;

	
	endswitch;
});


Request::method('xls-downloads',function($action,$id){
	switch($action):

	case 'edit':
	
	break;

	case 'delete':
	
	break;

	
	endswitch;
});

Request::method('xls-archive-original',function($id){
	load::model('admin/Xls_converter');
	class_alias('Xls_converter_model','Xls_converter');
    $xls_converter = new Xls_converter();

	//Get the Root Folder Name from the database
	load::model('admin/Download');
	class_alias('Download_model','Downloads');

	$download = new Downloads();

    $uploads = $xls_converter->getUploadsById($id);
	$path = SYSTEM_PATH.'/'.$uploads['root_path'];
	load::library('zip');
	$zip = new ZipArchiver();
	$downloads = 'resources/downloads/output_'.time().'.zip';
	$output = SYSTEM_PATH.'/'.$downloads;
	if($zip->zipDir($path,$output)){
		if($download->create([$id,'Raw Archive',$downloads,date('Y-m-d'),date('H:i:s'),0])){
			set_flashdata('message','Raw Archive Was Recently Downloaded','success');
			return redirect_to($downloads);
		}else{
			set_flashdata('message','Zip Not Archived','danger');
			return redirect_to('admin/tools/xls-converter');
		}

	}else{
		
	}
	
});


Request::method('column-removal',function($action){
	switch($action):

		case 'add':
			load::model('user/User');
			class_alias('User_model','User');
			$user = new User();
			$companies = $user->getCompany();
			$data['companies'] = $companies;
		load::php_file('admin/views/column-removal/add',$data);
		break;

		case 'manage':
			load::model('admin/Column_removal');
			class_alias('Column_removal_model','Columns_removal');
			$Columns_model = new Columns_removal();
			$columns =$Columns_model->getAllUploads();
			$data['columns'] = $columns;
		load::php_file('admin/views/column-removal/manage',$data);
		break;

		case 'all-downloads':
			load::model('admin/Column_downloads');
			class_alias('Column_downloads_model','Downloads');
			$download = new Downloads();
			$data['downloads'] = $download->getDownloads();
		load::php_file('admin/views/column-removal/mydownloads',$data);
		break;

    endswitch;
});


Request::method('column-removal-upload',function(){
	$data = array();
	$company_name = sanitise(post('company'));
	$contact_person = sanitise(post('contact'));

	$column_from = sanitise(post('column_from'));
	$column_to = sanitise(post('column_to'));

	// $uploaded_files = $_FILES['uploaded_files']??NULL;

	$v = new Validator();
	$validator = $v->init();

	$rules = $validator->make(post(),[
		'company'=>'required',
		'contact'=>'required',
		'column_from' =>'required',
		'column_to'=>'required',
	]);

	$rules->validate();
	if($rules->fails()){
		$error = $rules->errors();
		$data['error'] = $error->firstOfall();
	}

$uploaded_files = file_object('uploaded_files');
load::library('upload');
load::model('admin/Column_removal');
class_alias('Column_removal_model','Columns_removal');

$upload_dir = SYSTEM_PATH.'/resources/uploads/';
$upload = new Upload();
$upload->set($uploaded_files)
  ->max_size(100)
  ->allow_extension('zip')
  ->directory($upload_dir);

$tmpName = $uploaded_files['tmp_name'];

$fileinfo = pathinfo($uploaded_files['name']);
$extension = $fileinfo['extension'];
$filename = $fileinfo['filename'];

$random = rand(1111111111111111,9999999999999999);
$extracted_path = SYSTEM_PATH.'/resources/uploads/tools/'.$random;
if(!mkdir($extracted_path)){
	exit('* Cannot Make Directory');
}

if($extension=='zip'){
		$zip = new ZipArchive();
		if($zip->Open($tmpName)===TRUE){
		$zip->extractTo($extracted_path);
		$zip->close();
		}else{
			echo 'Something Went Wrong';
			exit;
		}
}

if($upload->do_upload()){
	$archived_data = json_encode($upload->file_info());
}

$details = scandir("{$extracted_path}/{$filename}");
unset($details[0],$details[1]);
$uploaded_path = json_encode([array("files"=>array_values($details),"count"=>count($details),"folder_name"=>$filename)]);
$is_processed=0;
$is_uploaded=1;
$is_deleted=0;
$root_path= 'resources/uploads/tools/'.$random;
$assets_path='';
$uploads = $uploaded_path;
$archived=$archived_data;
$date=date('Y-m-d');
$uploaded_at = date('H:i:s');
$processed_at = '';
$deleted_at = '';

$xls_converter = new Columns_removal();
if($xls_converter->create(compact(['company_name','contact_person','column_from','column_to','is_processed','is_uploaded','is_deleted','root_path','assets_path','uploads','archived','date','uploaded_at','processed_at','deleted_at']))){
set_flashdata('message','Zip Files Uploaded Successfully','success');
return redirect_to('admin/tools/column-removal/add');
}else{
set_flashdata('message','Zip Files Cannot be Uploaded','danger');
return redirect_to('admin/tools/column-removal/add');
}

});


// Delete Columns
Request::method('columns-process',function($id){
	$uploads = array();

	//Get the Root Folder Name from the database
	load::model('admin/Column_removal');
    class_alias('Column_removal_model','Columns_removal');
    $columns_model = new Columns_removal();
    $columns = $columns_model->getUploadsById($id);
    $columns_from = $columns['column_from'];
    $columns_to = $columns['column_to'];
	
	$path = SYSTEM_PATH.'/'.$columns['root_path'];
	$folder_name = json_decode($columns['uploads'],true)[0]['folder_name'];
	$excel_files = json_decode($columns['uploads'],true)[0]['files'];
	$path = $path.'/'.$folder_name;

	$random = rand(1111111111111111,9999999999999999);
	$csv_dir = SYSTEM_PATH.'/resources/support-tools/excel-csv/'.$random;
	if(!mkdir($csv_dir)){
		exit('* Cannot Make Directory');
	}

foreach($excel_files as $index => $excels):
$excel_file = pathinfo($excels,PATHINFO_FILENAME);
$xls_file = $path."/{$excels}";
$reader = new Xlsx();
$spreadsheet = $reader->load($xls_file);
$loadedSheetNames = $spreadsheet->getSheetNames();
$worksheet = $spreadsheet->getSheetByName('Sheet1');
// Remove 5 columns (from A to C)
$worksheet->removeColumnByIndex($columns_from, $columns_to);
$writer = new Csv($spreadsheet);
foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    $writer->setSheetIndex($sheetIndex);
    $writer->save($csv_dir.'/'.$excel_file.'.csv');
}

endforeach;

$assets_path = 'resources/support-tools/excel-csv/'.$random;
if($columns_model->updateOnly(['assets_path'=>$assets_path,'is_processed'=>1],$id)){
	set_flashdata('message','Files Processed Successfully','success');
		return redirect_to('admin/tools/column-removal/manage');
}else{
	set_flashdata('message','Files Cannot be Processed','danger');
		return redirect_to('admin/tools/column-removal/manage');
}

});


Request::method('column-manage',function($action,$id){

	load::model('admin/Column_removal');
    class_alias('Column_removal_model','Columns_removal');
    $columns_model = new Columns_removal();
    $columns = $columns_model->getUploadsById($id);

	switch($action):

	case 'edit':
		
	break;

	case 'delete':
	
	break;

	case 'archive':
			//Get the Root Folder Name from the database
	load::model('admin/Column_downloads');
	class_alias('Column_downloads_model','Downloads');

	$download = new Downloads();
	$path = SYSTEM_PATH.'/'.$columns['assets_path'];
	load::library('zip');
	$zip = new ZipArchiver();
	$downloads = 'resources/downloads/output_'.time().'.zip';
	$output = SYSTEM_PATH.'/'.$downloads;
	if($zip->zipDir($path,$output)){
		if($download->create([$id,'Processed Archive',$downloads,date('Y-m-d'),date('H:i:s'),0])){
			set_flashdata('message','Processed Archive Was Recently Downloaded','success');
			return redirect_to($downloads);
		}else{
			set_flashdata('message','Zip Not Archived','danger');
			return redirect_to('admin/tools/xls-converter');
		}

	}else{
		
	}
	
	break;

	
	endswitch;
});


Request::method('columns-archive-original',function($id){
	load::model('admin/Column_removal');
    class_alias('Column_removal_model','Columns_removal');
    $columns_model = new Columns_removal();
    $columns = $columns_model->getUploadsById($id);
	//Get the Root Folder Name from the database
	load::model('admin/Column_downloads');
	class_alias('Column_downloads_model','Downloads');

	$download = new Downloads();

    $columns = $columns_model->getUploadsById($id);
	$path = SYSTEM_PATH.'/'.$columns['root_path'];
	load::library('zip');
	$zip = new ZipArchiver();
	$downloads = 'resources/downloads/output_'.time().'.zip';
	$output = SYSTEM_PATH.'/'.$downloads;
	if($zip->zipDir($path,$output)){
		if($download->create([$id,'Raw Archive',$downloads,date('Y-m-d'),date('H:i:s'),0])){
			set_flashdata('message','Raw Archive Was Recently Downloaded','success');
			return redirect_to($downloads);
		}else{
			set_flashdata('message','Zip Not Archived','danger');
			return redirect_to('admin/tools/xls-converter');
		}

	}else{
		
	}
	
});



Request::method('duplicate-removal',function($action){

load::model('admin/Xls_converter');
switch($action):

		case 'add':
			load::model('user/User');
			class_alias('User_model','User');
			$user = new User();
			$companies = $user->getCompany();
			$data['companies'] = $companies;
		load::php_file('admin/views/duplicate-removal/add',$data);
		break;

		case 'manage':
			load::model('admin/Duplicates');
			class_alias('Duplicates_model','Duplicates');
			$duplicate = new Duplicates();
			$data['duplicates'] = $duplicate->getAllUploads();
		load::php_file('admin/views/duplicate-removal/manage',$data);
		break;

		case 'all-downloads':
			load::model('admin/Duplicate_download');
			class_alias('Duplicate_download_model','Duplicate_download');
			$download = new Duplicate_download();
			$data['downloads'] = $download->getDownloads();
		load::php_file('admin/views/duplicate-removal/mydownloads',$data);
		break;

		case 'download-logs':
			load::model('admin/Duplicates');
			class_alias('Duplicates_model','Duplicates');
			$duplicate = new Duplicates();
			$data['duplicates'] = $duplicate->getAllUploads();
		load::php_file('admin/views/duplicate-removal/logs',$data);
		break;

    endswitch;

});


Request::method('duplicate-removal-upload',function(){
$data = array();
	//Get the Form Fields
	$company_name = sanitise(post('company'));
	$contact_person = sanitise(post('contact'));
	$file_type = sanitise(post('file_type'));

	//Validation Code Non Upload Fields
	$v = new Validator();
	$validator = $v->init();

	$rules = $validator->make(post(),[
		'company'=>'required',
		'contact'=>'required',
		'file_type' =>'required',
	]);

	//Validate the Rules 
	$rules->validate();
	if($rules->fails()){
		$error = $rules->errors();
		$data['error'] = $error->firstOfall();
	}
//Get the Uploaded File from the Object
$uploaded_files = file_object('uploaded_files');
load::library('upload');
//Load the Model of Duplicates
load::model('admin/Duplicates');
class_alias('Duplicates_model','Duplicates');
//Set the Path
$upload_dir = SYSTEM_PATH.'/resources/uploads/';
$upload = new Upload();
$upload->set($uploaded_files)
  ->max_size(500)
  ->allow_extension('zip')
  ->directory($upload_dir);

$tmpName = $uploaded_files['tmp_name'];

$fileinfo = pathinfo($uploaded_files['name']);
$extension = $fileinfo['extension'];
$filename = $fileinfo['filename'];

$random = rand(1111111111111111,9999999999999999);
$extracted_path = SYSTEM_PATH.'/resources/uploads/tools/'.$random;
if(!mkdir($extracted_path)){
	exit('* Cannot Make Directory');
}

if($extension=='zip'){
		$zip = new ZipArchive();
		if($zip->Open($tmpName)===TRUE){
		$zip->extractTo($extracted_path);
		$zip->close();
		}else{
			echo 'Something Went Wrong';
			exit;
		}
}

if($upload->do_upload()){
	$archived_data = json_encode($upload->file_info());
}

$details = scandir("{$extracted_path}/{$filename}");
unset($details[0],$details[1]);
$uploaded_path = json_encode([array("files"=>array_values($details),"count"=>count($details),"folder_name"=>$filename)]);
$is_processed=0;
$is_uploaded=1;
$is_deleted=0;
$root_path= 'resources/uploads/tools/'.$random;
$assets_path='';
$uploads = $uploaded_path;
$archived=$archived_data;
$date=date('Y-m-d');
$uploaded_at = date('H:i:s');
$processed_at = '';
$deleted_at = '';

$duplicate = new Duplicates();
if($duplicate->create(compact(['company_name','contact_person','file_type','is_processed','is_uploaded','is_deleted','root_path','assets_path','uploads','archived','date','uploaded_at','processed_at','deleted_at']))){

	set_flashdata('message',"{$GLOBALS['success']} Zip with {$file_type} Files Uploaded Successfully",'success');
	return redirect_to("admin/tools/duplicate-removal/add");

}else{

	set_flashdata('message',"{$GLOBALS['warning']} Zip  with {$file_type} Files Cannot be Uploaded",'danger');
	return redirect_to("admin/tools/duplicate-removal/add ");
}

});

//Remove Duplicates
Request::method('duplicate-process',function($id){
	$uploads = array();

	//Get the Root Folder Name from the database
	load::model('admin/Duplicates');
	class_alias('Duplicates_model','Duplicates');

    $duplicate = new Duplicates();
    $duplicates = $duplicate->getUploadsById($id);
    $file_type = $duplicates['file_type'];

	
	$path = SYSTEM_PATH.'/'.$duplicates['root_path'];
	$folder_name = json_decode($duplicates['uploads'],true)[0]['folder_name'];
	$excel_files = json_decode($duplicates['uploads'],true)[0]['files'];
	$path = $path.'/'.$folder_name;

	$random = rand(1111111111111111,9999999999999999);
	$txt_dir = SYSTEM_PATH.'/resources/support-tools/txt-txt/'.$random;
	if(!mkdir($txt_dir)){
		exit('* Cannot Make Directory');
	}

//Process the Code
//Increase the Memory Limit
ini_set('memory_limit', '-1');
//Require the [___CSV___INC___] Include PHP File
load::php_file('package/txt-handling/txt.inc');

$input = scandir($path);
unset($input[0],$input[1]);

foreach($input as $file){
	
	//Read the Data from File with a Single Columns
	$array = read_txt("{$path}/{$file}");
	
	// Find the Unique Logic
	$unique = array_keys(array_flip($array));
	
	//Activity of FileName with Total Counts and Unique Counts
	$count = count($array);
	$unique_count = count($unique);
	// $logs[] = "Filename {$file} contains {$count} and has {$unique_count} Unique Emails";

	$logsdata[]= ['filename'=>$file,'total_count'=>$count,'unique_count'=>$unique_count];

	//Write the Data from File with a Single Columns
	write_txt("{$txt_dir}/{$file}",$unique);
	
}

$assets_path = 'resources/support-tools/txt-txt/'.$random;
$logs = json_encode($logsdata);

if($duplicate->updateOnly(['assets_path'=>$assets_path,'is_processed'=>1,'logs'=>$logs,'processed_at'=>date("H:i:s")],$id)){
	set_flashdata('message','Files Processed Successfully','success');
		return redirect_to('admin/tools/duplicate-removal/manage');
}else{
	set_flashdata('message','Files Cannot be Processed','danger');
		return redirect_to('admin/tools/duplicate-removal/manage');
}

});


// Code to Archive
Request::method('duplicate-manage',function($action,$id){
	load::model('admin/Duplicates');
	class_alias('Duplicates_model','Duplicates');

    $duplicate = new Duplicates();

	switch($action):

	case 'edit':
		
	break;

	case 'delete':
	
	break;

	case 'archive':
			//Get the Root Folder Name from the database
	load::model('admin/Duplicate_download');
	class_alias('Duplicate_download_model','Duplicate_download');

	$download = new Duplicate_download();
    $duplicates = $duplicate->getUploadsById($id);

	$path = SYSTEM_PATH.'/'.$duplicates['assets_path'];
	load::library('zip');
	$zip = new ZipArchiver();
	$downloads = 'resources/downloads/output_'.time().'.zip';
	$output = SYSTEM_PATH.'/'.$downloads;
	if($zip->zipDir($path,$output)){
		if($download->create([$id,'Processed Archive',$downloads,date('Y-m-d'),date('H:i:s'),0])){
			set_flashdata('message','Processed Archive Was Recently Downloaded','success');
			return redirect_to($downloads);
		}else{
			set_flashdata('message','Zip Not Archived','danger');
			return redirect_to('admin/tools/duplicate-removal/manage');
		}

	}else{
		
	}
	
	break;
	endswitch;
});



Request::method('duplicate-archive-original',function($id){
	load::model('admin/Duplicates');
	class_alias('Duplicates_model','Duplicates');

    $duplicate = new Duplicates();
    $duplicates = $duplicate->getUploadsById($id);
	//Get the Root Folder Name from the database
	load::model('admin/Duplicate_download');
	class_alias('Duplicate_download_model','Duplicate_download');

	$download = new Duplicate_download();
	$path = SYSTEM_PATH.'/'.$duplicates['root_path'];
	load::library('zip');
	$zip = new ZipArchiver();
	$downloads = 'resources/downloads/output_'.time().'.zip';
	$output = SYSTEM_PATH.'/'.$downloads;
	if($zip->zipDir($path,$output)){
		if($download->create([$id,'Raw Archive',$downloads,date('Y-m-d'),date('H:i:s'),0])){
			set_flashdata('message','Raw Archive Was Recently Downloaded','success');
			return redirect_to($downloads);
		}else{
			set_flashdata('message','Zip Not Archived','danger');
			return redirect_to('admin/tools/duplicate-removal/manage');
		}

	}else{
		
	}
	
});


Request::method('duplicates-logs-download',function($id){
	
	load::model('admin/Duplicates');
	class_alias('Duplicates_model','Duplicates');
    $duplicate = new Duplicates();
    $duplicates = $duplicate->getUploadsById($id);
    $logs = json_decode($duplicates['logs'],true);

//Process the Code
//Increase the Memory Limit
ini_set('memory_limit', '-1');
//Require the [___CSV___INC___] Include PHP File
load::php_file('package/txt-handling/txt.inc');

$rows[0] = array("FileName","Total Emails","Unique Emails");
foreach ($logs as $key => $value) {
	$rows[$key+1] = $value; 
}
ob_clean();
ob_start();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.time().'.csv');
write_csv("php://output",$rows);
exit;
// return redirect_to($downloads);
});



Request::method('duplicate-manage',function($action,$id){

switch($action):
	case 'edit':
		break;

	case 'delete':
		break;

	case 'output-csv';
		load::model('admin/Duplicates');
		class_alias('Duplicates_model','Duplicates');
		$duplicate = new Duplicates();
		$duplicates = $duplicate->getUploadsById($id);
		$logs = json_decode($duplicates['logs'],true);
		//Increase the Memory Limit
		ini_set('memory_limit', '-1');
		//Require the [___CSV___INC___] Include PHP File
		load::php_file('package/txt-handling/txt.inc');
		$rows[0] = array("FileName","Total Emails","Unique Emails");

		foreach ($logs as $key => $value) {
			$rows[$key+1] = $value; 
		}

				$downloads = 'resources/downloads/output_'.time().'.csv';
				$output = SYSTEM_PATH.'/'.$downloads;
				write_csv($output,$rows);
				return redirect_to($downloads);
	break;

endswitch;
	
});