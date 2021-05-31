<?php
function bread_crumb($title=''){

$crumbs = explode("/",parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH));
$tmp ='<ol class="breadcrumb">';
$str="";
foreach($crumbs as $crumb){

    $str=$str.$crumb."/";
    $url  = substr($str, 0,-1);
    $tmp.= '<li class="breadcrumb-item"><a href="'.$url.'">';
    $tmp.=ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ');
    $tmp.=  '</a></li>';    
}
echo $tmp.'<li class="breadcrumb-item active">'.$title."</li></ol>";
}
    


?>