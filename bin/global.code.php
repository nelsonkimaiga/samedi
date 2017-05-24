<?php

function date_time() //working: modified 23/03/2014 : 23.39
{
	date_default_timezone_set("Africa/Nairobi");
	return date("d/m/Y") . " At: " . date("H:i") ;
}

function replaceAppo($str) //working: modified 24/03/2014 : 00.17
{
$str_new = $str;
if(strpos($str,"'"))
	{
	$str_new = str_replace("'","&#8217;",$str);
	}
return $str_new;
}

function replaceAppo_reverse($str) //working: modified 24/03/2014 : 00.17
{
$str_new = $str;
if(strpos($str,"&#8217;"))
	{
	$str_new = str_replace("&#8217;","'",$str);
	}
return $str_new;
}

function replaceNewLine($x)
{
	$new = str_replace("<br />","\n",$x);
	return $new;

}

function replaceNewLine_Reverse($x)
{
	$new = str_replace("\n","<br />",$x);
	return $new;

}

function removeCharacters($strToSearch, $charToRemove){
	$arrChar = explode(',',$charToRemove);
	
	for($i=0; $i<count($arrChar); $i++){
		if(strpos($strToSearch,$arrChar[$i])){
			$strToSearch = str_replace($arrChar[$i],'',$strToSearch);
		}
	}
	return $strToSearch;
}

?>