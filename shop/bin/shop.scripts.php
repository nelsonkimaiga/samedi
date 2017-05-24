<?php

//money scripts//
function substractCash($x,$y){
	$x = removeComma($x);
	$y = removeComma($y);
	
	$rem = $x - $y;
	return insertComma($rem);
}

function removeComma($num){
	$num = str_replace(',','',$num);
	return $num;
}

function insertComma($num){
if(strlen($num)==4){
	$str = substr_replace($num,',',1);
	$strend = substr($num,1);
 }elseif(strlen($num)==5){
	$str = substr_replace($num,',',2);
	$strend = substr($num,2);
  }elseif(strlen($num)==6){
	$str = substr_replace($num,',',3);
	$strend = substr($num,3);
   }else{
	$str = $num;
	$strend = '';
    }

return $str.$strend;
}
?>