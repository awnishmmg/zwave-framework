<?php
define('DOCUMENT_ROOT',dirname(__DIR__));

//Read the __init__
require_once __DIR__."/init.inc.php";

//Read the Splits Files

$splits=scandir('splits/');
unset($splits[0],$splits[1]);

$unique_emails = [];

foreach ($splits as $index => $file) {
	$rows=read_csv(DOCUMENT_ROOT."/core/splits/$file",100000);

	$emails = [];
	foreach ($rows as $key => $row) {
		foreach ($row as $index => $value) {
			$emails[] = $value;
		}
	}
	
	
}

$unique_emails[]=array_unique($emails);

$email_count = count($unique_emails);

echo "List of Emails is \n : ".
print_r($unique_emails);

echo "\n No of Unique Emails is : {$email_count} \n ";








