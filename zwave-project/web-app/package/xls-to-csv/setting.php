<?php



return [

'project_path' => define('SYSTEM_ROOT',__DIR__),
'database' =>[

	'user' => 'root',
	'port' => 3306,
	'name' => 'practise',
	'password'=>'',
	'host'=>'127.0.0.1',
],

'resources' =>[

	'zip_dir'=> 'zip',
	'upload_dir' => 'upload',
	'csv_dir' => 'csv',
	'archived_dir' => 'archive'
]



];
