<?php
define('DOCUMENT_ROOT',dirname(__DIR__));

//Read the __init__
require_once __DIR__."/init.inc.php";

//Read the Text/plain
#header("Content-Type: text/plain");

//Read from csv
$splits=scandir('splits/');
unset($splits[0],$splits[1]);

$i=1;
foreach ($splits as $index => $file) {
	$rows=read_csv(DOCUMENT_ROOT."/core/splits/$file",100000);
	echo "Writing.. in $i file \n ";
	write_csv(DOCUMENT_ROOT."/csv/$file",$rows);
	$i++;

}








