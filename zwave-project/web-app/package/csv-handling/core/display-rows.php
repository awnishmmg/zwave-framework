<?php
define('DOCUMENT_ROOT',dirname(__DIR__));

//Read the __init__
require_once __DIR__."/init.inc.php";

//Read the Text/plain
#header("Content-Type: text/plain");

//Read from csv
$splits=scandir('splits/');
unset($splits[0],$splits[1]);

$data_emails=array();

$i=0;
foreach ($splits as $index => $file) {
	$rows=read_csv(DOCUMENT_ROOT."/core/splits/$file",49999);
	echo "Data from file-$i \n ";
	foreach ($rows as $j => $row) {
		$email = $rows[0];
		$data_emails[] = $email;
		#array_push($data_emails, $email);
	}
	$i++;

}

$compares=scandir('compares/');
unset($compares[0],$compares[1]);
$supress_emails=array();

$i=0;
foreach ($compares as $index => $file) {
	$rows=read_csv(DOCUMENT_ROOT."/core/compares/$file",49999);
	echo "Data from file-$i \n ";
	foreach ($rows as $j => $row) {
		$email = $rows[0];
		$supress_emails[] = $email;
		#array_push($data_emails, $email);
	}
	$i++;

}

$fp=fopen("unique.txt","w");

//Now Match Both and Find the Remove Which are Not found
foreach ($data_emails as $index => $master_email) {
	if(in_array($master_email, $supress_emails)){
		unset($data_emails[$index]);
	}
	fwrite($fp, $master_email."\n");
}

fclose($fp);








