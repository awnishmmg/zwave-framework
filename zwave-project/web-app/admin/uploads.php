<?php

Request::method('view-logs',function(){
	load::php_file('admin/views/uploads/view');
});

Request::method('import',function(){
	
});

Request::method('import-settings',function(){
	Load::php_file('admin/views/uploads/import-settings');
});

Request::method('misscall-logs',function(){
	load::php_file('admin/views/uploads/misscall-view');
});

?>