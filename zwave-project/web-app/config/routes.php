<?php
	
$routes['admin:partners'] = array('edit','view','add','create','procure-numbers','manage-numbers','change-status');
$routes['admin:uploads'] = array('view-logs','import','import-settings','misscall-logs');
$routes['admin:manage-misscall'] = array('assign-number','assign');
$routes['admin:dashboard'] = array('main','logout');
$routes['admin:manage-user'] = array('add-new','add-new-bdagent','user','bds','delete','bds-delete');
$routes['admin:department'] = array('manage','add');
$routes['admin:integration'] = array('show-api','sms-apiduplicate-removal','create');
$routes['admin:chat-bot'] = array('add','show-record','create','edit','delete','more','update');
$routes['admin:change-login'] = array('user','admin');
$routes['admin:setting'] = array('all','create','change');
$routes['admin:contacts'] = array('add','manage','create'); 
$routes['admin:tools'] = array('xls-converter','xls-upload','column-removal','xls-process','xls-manage','xls-archive-original','column-removal-upload','columns-process',
	'column-manage','columns-archive-original','duplicate-removal','duplicate-removal-upload','duplicate-process','duplicate-manage','duplicate-archive-original','duplicates-logs-download');
$routes['admin:tools-compaigns'] = array('add','manage','create','all-downloads','download-logs');



