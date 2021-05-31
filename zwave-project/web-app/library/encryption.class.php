<?php
define('MAX_BIT',8);
if(defined('MAX_BIT'))__HASHBYTES__();
/**Encryption Class
  ****************************************************************************************
  Encryption Class : No Body`s Father Can Decrypt
  ****************************************************************************************
` License : AHD-XDD-4000-WACH-YEND-46YD
  Author Name : Awnish Kumar
*/  

function encode_64($item){	
	$bit_size = MAX_BIT;
	$digit_min = 49;
	$digit_max = 57;
	$base_index=0;
	$last_index=($bit_size-2);
	$char_min = 97;
	$char_max = 122;
$convert = [
	'0' => 'a' ,
	'1' => 'f' ,
	'2' => 'b' ,
	'3' => 'g' ,
	'4' => 'c' ,
	'5' => 'p' ,
	'6' => 'e' ,
	'7' => 'm' ,
	'8' => 'v' ,
	'9' => 'z' ,
	'a' => 'k',
	'b' => 'l',
];
$rev = "";
for($i=strlen($item)-1;$i>=0;$i--){
	$mix = $convert[$item[$i]];
	$rev=$rev.$mix;
}
$trim_length = strlen($rev);
$str="";
for($i=0;$i<($bit_size/2);$i++){
	$str=$str.chr(rand($digit_min,$digit_max)).chr(rand($char_min,$char_max));
}
$k=rand(0,$bit_size/10);
$str[$base_index]=$k;
$m = rand(0,$bit_size%10);
$str[$last_index]=$m;
$arr=str_split($str);
$index =($k*10+$m);
$arr[$index]=$rev;
$x="";
foreach ($arr as $key => $value) {
	$x = $x.$value;
}
	return urlencode(base64_encode($x.$index.$trim_length));	
}
function decode_64($hash){
	$decrypted=base64_decode(urldecode($hash)); 
	$size = $decrypted[strlen($decrypted)-1];
	$length = strlen($decrypted)-1;
	$first = $decrypted[$length-2]; 
	$second = $decrypted[$length-1];
	$position="{$first}{$second}";
	$char = $position[0]; 
	if(ctype_digit($char)){
		return decode($decrypted,$position,$size);
	}else{
		return decode($decrypted,$second,$size);
	}	 
}
function __HASHBYTES__(){
	(MAX_BIT>99)?exit('Maximum Encryption size is 99-BIT'):"";
}
function decode($hash,$index,$size){
$convert = [

	'a'=>'0' ,
	'f'=>'1' ,
	'b'=>'2' ,
	'g'=>'3' ,
	'c'=>'4' ,
	'p'=>'5' ,
	'e'=>'6' ,
	'm'=>'7' ,
	'v'=>'8' ,
	'z'=>'9' ,
	'k'=>'a' ,
	'l'=>'b' ,
];
$hash_arr = str_split($hash);
$min = $index;
$max = $size + $index;
$item = "";
for($i=$min;$i<$max;$i++){
	$item = $item.$hash_arr[$i];
}
$item_arr = str_split($item);
$tmp =[];
$i=0;
foreach ($item_arr as $key => $value) {
	$tmp[$i] = $convert[$value];
	$i++;
}
return strrev(join($tmp));
}


