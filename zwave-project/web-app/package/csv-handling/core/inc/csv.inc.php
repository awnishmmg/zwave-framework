<?php

// To Read Number of Rows
function get_count($filename){
 return count(file($filename));
}

//To Read CSV Array
function read_csv($filename,$no_rows){  
$rows=[];
$i=0;
foreach (file($filename,FILE_IGNORE_NEW_LINES) as $line) {
	$rows[] = str_getcsv($line);
	if($i==$no_rows){
		break;
	}
	$i++;
}
return $rows;
}

function getheader_csv($filename){  
$rows=[];
foreach (file($filename,FILE_IGNORE_NEW_LINES) as $line) {
	$rows[] = str_getcsv($line);
}
$headers[] = $rows[0];
return $headers;
}


function write_csv($filename, $rows){
	$fp = fopen($filename, "w");
	foreach ($rows as $csv_row) {
		fputcsv($fp, $csv_row);
	}
}




