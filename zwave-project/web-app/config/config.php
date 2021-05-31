<?php
define('autoloading',TRUE);

$autoload['define']=array('lang','error');

$autoload['config']=array('init','database','define','loader');

$autoload['library'] =array('query-builder.class','relationship.class','design.class','model-loader.class','encryption.class','pagination/pagination.class','validation.class');

#Helpers Loaders

$autoload['helper'] =array('debugger','ajax','uri_segment','htaccess',
	'json','date','ui','lexical','download','file','flash','uploads'); #_helper

$autoload['model'] = array(); #_model
$autoload['functions'] = array('timestamp','errors','functions','flash','bread_crumbs'); #_model
// $autoload['package']=array('xls-to-csv');

$db['prefix'] = 'tbl_';

#All the modular projects projects

$modular['admin']='admin';
$modular['ajax']='ajax';
$modular['api']='api';

#Add the Code Snippet
#$autoload['snippet']=array('code');

?>