<?php
require 'vendor\autoload.php';
require_once 'init.php';

use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use \PhpOffice\PhpSpreadsheet\Writer\Csv;



$if_uploaded  = false;

if(isset($_POST['submit'])){

	$files_arr = $_FILES['files'];
	
	$fileinfo = pathinfo($files_arr['name']);
	
	$tmpName = $files_arr['tmp_name'];

	$extension = $fileinfo['extension'];
	$filename = $fileinfo['filename'];

	if($extension=='zip'){
		$zip = new ZipArchive();

		if($zip->Open($tmpName)===TRUE){

		$random = time();
		$extracted_path = "{$settings['resources']['upload_dir']}/{$random}";
		
		$zip->extractTo($extracted_path);
		$zip->close();

			$if_uploaded = true;

		}else{
			echo 'Something Went Wrong';
		}
	}else{
		echo 'Invalid File';
		exit; 
	}

if($if_uploaded == true){
		
		echo 'File Is Extracted...  <br/>';
		//Create the Directory
		if(!mkdir($settings['resources']['csv_dir'].'/'.$random)){
			exit('Cannot Created the Directory');
		}

		$zipped_files=scandir($extracted_path."/{$filename}");
		unset($zipped_files[0],$zipped_files[1]);		

foreach($zipped_files as $index => $excels):
$excel_file = pathinfo($excels,PATHINFO_FILENAME);
#print_r($excel_file);

$xls_file = $extracted_path."/{$filename}/{$excels}";
$reader = new Xlsx();
$spreadsheet = $reader->load($xls_file);

$loadedSheetNames = $spreadsheet->getSheetNames();

$writer = new Csv($spreadsheet);

foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    $writer->setSheetIndex($sheetIndex);
    $writer->save($settings['resources']['csv_dir'].'/'.$random.'/'.$excel_file.'.csv');
}

endforeach;

	exit; 
}

}
// Code For Converting Files to Csv

