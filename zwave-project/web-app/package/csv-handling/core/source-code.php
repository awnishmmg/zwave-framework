<?php
define('DOCUMENT_ROOT',dirname(__DIR__));

//Read the __init__
require_once __DIR__."/init.inc.php";

//Read the Text/plain
header("Content-Type: text/plain");

//Read from csv
$rows=read_csv(DOCUMENT_ROOT."/sample.csv");

//Getting Headers
getheader_csv(DOCUMENT_ROOT."/sample.csv");

//Process
$rows[] = array("1001","Manujul","lkg","000"); 
$rows[] = array("1002","Chandan","UKG","100"); 


//writing in the File
write_csv(DOCUMENT_ROOT."/csv/output.csv",$rows);






